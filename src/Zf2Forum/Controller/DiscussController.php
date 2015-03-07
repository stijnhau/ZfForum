<?php

namespace Zf2Forum\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\ResponseDescription as Response;

class DiscussController extends AbstractActionController
{
    protected $discussService;
    protected $tag;
    protected $thread;
    protected $moduleOptions;
    protected $userMapper;

    /**
     * gets User Mapper
     *
     * @return Zf2Forum\Mapper\UserMapper
     */
    protected function getUserMapper()
    {
        if (!$this->userMapper) {
            $this->userMapper = $this->getServiceLocator()->get('zfcuser_user_mapper');
        }

        return $this->userMapper;
    }

    /**
     * gets module options from ServiceManager
     *
     * @return \Zf2Forum\Options\ModuleOptions
     */
    protected function getModuleOptions()
    {
        if (!$this->moduleOptions) {
            $this->moduleOptions = $this->getServiceLocator()->get('Zf2Forum\ModuleOptions');
        }

        return $this->moduleOptions;
    }

    public function forumsAction()
    {
        $tags = $this->getDiscussService()->getCategories();

        return new ViewModel(
            array(
                'tags'          => $tags,
                'showTimeAgo'   => $this->getModuleOptions()->getShowTimeAgo(),
            )
        );

    }

    public function threadsAction()
    {
        $verifyTag = $this->verifyTag();
        if (-1 === $verifyTag) {
            $response = $this->getResponse();
            $response->setStatusCode(404);
            return $response;
        }

        $tag = $this->getTag();

        if (0 === $verifyTag) {
            return $this->redirect()->toRoute(
                'forum/category',
                array(
                    'categoryid'   => $tag->getId()
                )
            );
        }

        $threads = $this->getDiscussService()->getLatestThreads(25, 0, $tag->getid());
        $form = $this->getServiceLocator()->get('Zf2Forum_form');

        return new ViewModel(
            array(
                'tag'           => $tag,
                'threads'       => $threads,
                'showTimeAgo'   => $this->getModuleOptions()->getShowTimeAgo(),
                'form'          => $form
            )
        );
    }

    protected function messagesAction()
    {
        $verifyThread = $this->verifyThread();

        if (-1 == $verifyThread) {
            /**
             * @todo make a nice template for over here
             */
            die();
        } else {
            $thread = $this->getThread();
/*
            // Store visit if unique.
            $visit = $this->getServiceLocator()->get('Zf2Forum_visit');
            $visit->setThread($thread);
            $this->getDiscussService()->storeVisitIfUnique($visit);

            // Get messages.
            $replys = $this->getDiscussService()->getMessagesByThread($thread);
*/
            $messages = array($thread);

            // Create new form instance.
            $form = $this->getServiceLocator()->get('Zf2Forum_form');

            // Return a view model.
            return new ViewModel(
                array(
                    'thread'         => $thread,
                    'messages'       => $messages,
                    'showQuickReply' => $this->getModuleOptions()->getShowQuickReply(),
                    'showTimeAgo'    => $this->getModuleOptions()->getShowTimeAgo(),
                    'form'           => $form
                )
            );
        }
    }

    public function newmessageAction()
    {
        // Create new form and hydrator instances.
        $form = $this->getServiceLocator()->get('Zf2Forum_form');
        $formHydrator = $this->getServiceLocator()->get('Zf2Forum_post_form_hydrator');

        $tag = $this->getTag();
        $thread = $this->getThread();

        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost()) {
            // POST, so check if valid.
            $data = (array) $request->getPost();

            // create a new message and sets its thread.
            $message = $this->getServiceLocator()->get('Zf2Forum_message');
            $message->setThread($thread);

            $form->setHydrator($formHydrator);
            $form->bind($message);
            $form->setData($data);
            if ($form->isValid()) {
                // Persist message.
              $this->getDiscussService()->createMessage($message);

              // Redirect to list of messages
            return $this->redirect()->toRoute(
                'Zf2Forum/thread',
                array(
                    'tagslug'    => $tag->getSlug(),
                        'tagid'      => $tag->getTagId(),
                        'threadslug' => $thread->getSlug(),
                        'threadid'   => $thread->getThreadId(),
                    'action'     => 'messages'
                )
            );
            }
        }

        // If not a POST request, then just render the form.
        return new ViewModel(
            array(
                'form'   => $form,
                'tag'    => $tag,
                'thread' => $thread
            )
        );

    }

    public function newthreadAction()
    {
      // Create new form instance.
        $form = $this->getServiceLocator()->get('Zf2Forum_form');
        $formHydrator = $this->getServiceLocator()->get('Zf2Forum_post_form_hydrator');

        $category = $this->getTag();

        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost()) {
          // if post, check if valid
            $data = (array) $request->getPost();

            // create a new thread and sets its tag.
            $topic = $this->getServiceLocator()->get('Zf2Forum_thread');

            $form->setHydrator($formHydrator);
            $form->bind($topic);
            $form->setData($data);
            if ($form->isValid()) {
                // Persist message and thread.
                $thread = $this->getDiscussService()->createThread($category, $topic);

                // Redirect to list of messages
                return $this->redirect()->toRoute(
                    'Zf2Forum/thread',
                    array(
                        'threadid'   => $thread->getThreadId(),
                        'action'     => 'messages'
                    )
                );
            }
        }

        // If not a POST request, then just render the form.
        return new ViewModel(
            array(
                'form'      => $form,
                'category'  => $category
            )
        );
    }

    public function verifyTag()
    {
        $tag = $this->getTag();

        if (!$tag) {
            return -1;
        } else if ($tag->getId() !== $this->getEvent()->getRouteMatch()->getParam('categoryid')) {
            // fix slug name if it's wrong, redirect to the proper one
            return 0;
        }
        return 1;
    }

    public function verifyThread()
    {
        $thread = $this->getThread();

        if (!$thread) {
            $response = $this->getResponse();
            $response->setStatusCode(404);
            return -1;
        } else if ($thread->getId() !== $this->getEvent()->getRouteMatch()->getParam('topicid')) {
            // fix slug name if it's wrong, redirect to the proper one
            return 0;
        }
        return 1;
    }

    public function getTag()
    {
        if (null !== $this->tag) {
            return $this->tag;
        }
        $categoryId = $this->getEvent()->getRouteMatch()->getParam('categoryid');
        return $this->tag = $this->getDiscussService()->getCategoryById($categoryId);
    }

    protected function getThread()
    {
        if (null !== $this->thread) {
            return $this->thread;
        }
        $topicId = $this->getEvent()->getRouteMatch()->getParam('topicid');
        return $this->thread = $this->getDiscussService()->getTopicById($topicId);
    }

    public function getDiscussService()
    {
        if (null === $this->discussService) {
            $this->discussService = $this->getServiceLocator()->get('Zf2Forum_discuss_service');
        }

        return $this->discussService;
    }

    public function setDiscussService($discussService)
    {
        $this->discussService = $discussService;
        return $this;
    }
}
