<?php
/**
 * Page class
 */
class Page {
    // ID attribute
    public $id;

    // Name attribute
    public $name;

    // Description attribute
    public $description;

    // Constructor
    public function __construct($id, $name, $description) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }
}
