<?php

namespace App\Models;

class Task {

    /**
     * Unique Fields
     */
    public $TASK10_ID; // Task ID
    public $TASK10_TITL; // Task Title
    public $TASK10_DESC; // Task Description
    public $TASK10_STUS; // Task Status
    public $TASK10_DUED; // Task Due Date

    /**
     * Log Fields
     */
    public $TASK10_CRTD; // Created DateTime
    public $TASK10_CRTU; // Created User
    public $TASK10_CRTP; // Created Program
    public $TASK10_LUPD; // Last Updated DateTime
    public $TASK10_LUPU; // Last Updated User
    public $TASK10_LUPP; // Last Updated Program
    public $TASK10_DFLG; // Delete Flag

    public function __construct($id = null, $title = null, $desc = null, $status = null, $date = null) {
        $this->constructFromInput($id, $title, $desc, $status, $date);
    }

    public function constructFromInput($id, $title, $desc, $status, $date) {
        $this->TASK10_ID = $id;
        $this->TASK10_TITL = $title;
        $this->TASK10_DESC = $desc;
        $this->TASK10_STUS = $status;
        $this->TASK10_DUED = $date;
    }

    public function constructFromObj($object) {
        $this->TASK10_ID = $object->TASK10_ID;
        $this->TASK10_TITL = $object->TASK10_TITL;
        $this->TASK10_DESC = $object->TASK10_DESC;
        $this->TASK10_STUS = $object->TASK10_STUS;
        $this->TASK10_DUED = $object->TASK10_DUED;
        $this->TASK10_CRTD = $object->TASK10_CRTD;
        $this->TASK10_CRTU = $object->TASK10_CRTU;
        $this->TASK10_CRTP = $object->TASK10_CRTP;
        $this->TASK10_LUPD = $object->TASK10_LUPD;
        $this->TASK10_LUPU = $object->TASK10_LUPU;
        $this->TASK10_LUPP = $object->TASK10_LUPP;
        $this->TASK10_DFLG = $object->TASK10_DFLG;
    }

    public function getId() {
        return $this->TASK10_ID;
    }

    public function getIdShort() {
        return (float) $this->TASK10_ID;
    }

    public function getTitle() {
        return $this->TASK10_TITL;
    }

    public function getDesc() {
        return $this->TASK10_DESC;
    }

    public function getDescShort() {
        if ( strlen($this->TASK10_DESC) > 64 ) {
            return substr($this->TASK10_DESC,0,64) . '...';
        } else {
            return $this->getDesc();
        }
    }

    public function getStatus() {
        switch ( $this->TASK10_STUS ) {
            case 0:
                return "Incomplete";
            case 1:
                return "In Progress";
            case 2:
                return "Complete";
            default:
                return "UNKNOWN_STATUS";
        }
    }

    public function getStatusValue() {
        return $this->TASK10_STUS;
    }

    public static function getStatusValues() {
        return [0, 1, 2];
    }

    public function setStatus($status) {
        $this->TASK10_STUS = $status;
    }

    public function getDueDate() {
        return $this->TASK10_DUED;
    }

    public function getModifiedDate() {
        return $this->TASK10_LUPD;
    }

    public function getCreatedDate() {
        return $this->TASK10_CRTD;
    }
}