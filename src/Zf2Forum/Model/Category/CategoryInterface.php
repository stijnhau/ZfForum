<?php
namespace Zf2Forum\Model\Category;

interface CategoryInterface
{
    public function getId();

    public function setId($_id);

    public function getName();

    public function setName($_name);

    public function getDescription();

    public function setDescription($_description);

    public function getTimestampcreated();

    public function setTimestampcreated($_timestampCreated);
}
