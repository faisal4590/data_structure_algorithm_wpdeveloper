<?php

// defining Node structure
class Node {
    public $data;
    public $next;
    public $prev;
}

class LinkedList {
    public $head;

    // constructor to create an empty LinkedList
    public function __construct(){
        $this->head = null;
    }

    //display the content of the list
    public function printList() {
        $temp = new Node();
        $temp = $this->head; // head ke kokhno amra change korbona, tai temp e head nilam
        if($temp !== null) {
            echo "The list contains: ";
            while($temp !== null) {
                echo $temp->data . " " ;
                $temp = $temp->next;
            }
            echo "<br>";
        } else {
            echo "The list is empty.<br>";
        }
    }

    //Add new element at the start of the list
    public function push_front($newElement) {

        // 1. allocate node
        $newNode = new Node();

        // 2. assign data element
        $newNode->data = $newElement;

        // 3. assign null to the next and prev
        //   of the new node
        $newNode->next = null;
        $newNode->prev = null;

        // 4. Check the list is empty or not,
        //   if empty make the new node as head
        if($this->head === null) {
            $this->head = $newNode;
        } else {
            // 5. Adjust the links and make the new
            //   node as head
            $this->head->prev = $newNode;
            $newNode->next = $this->head;
            $this->head = $newNode;
        }
    }

    //Add new element at the end of the list
    public function push_back($newElement) {
        //1. allocate node
        $newNode = new Node();
        //2. assign data element
        $newNode->data = $newElement;

        //3. assign null to the next and prev
        //   of the new node
        $newNode->next = null;
        $newNode->prev = null;

        //4. Check the list is empty or not,
        //   if empty make the new node as head
        if($this->head === null) {
            $this->head = $newNode;
        } else {

            //5. Else, traverse to the last node
            $temp = new Node();
            $temp = $this->head;
            while($temp->next !== null) {
                $temp = $temp->next;
            }

            //6. Adjust the links
            $temp->next = $newNode;
            $newNode->prev = $temp;
        }
    }

    //Inserts a new element at the given position
    public function push_at($newElement, $position) {

        //1. allocate node to new element
        $newNode = new Node();
        $newNode->data = $newElement;
        $newNode->next = null;
        $newNode->prev = null;

        //2. check if the position is > 0
        if($position < 1) {
            echo "\nposition should be >= 1.";
        } else if ($position === 1) {

            //3. if the position is 1, make new node as head
            $newNode->next = $this->head;
            $this->head->prev = $newNode;
            $this->head = $newNode;
        } else {

            //4. Else, make a temp node and traverse to the
            //   node previous to the position
            $temp = new Node();
            $temp = $this->head;
            for($i = 1; $i < $position - 1; $i++) {
                if($temp !== null) {
                    $temp = $temp->next; // head ke position er ager node e niye ashlam
                }
            }

            // 5. If the previous node is not null, adjust
            //   the links
            if($temp !== null) {
                $newNode->next = $temp->next;
                $newNode->prev = $temp;
                $temp->next = $newNode;
                if($newNode->next !== null){
                    $newNode->next->prev = $newNode;
                }
            } else {

                //6. When the previous node is null
                echo "\nThe previous node is null.";
            }
        }
    }

    // Delete first node of the list
    public function pop_front() {
        if($this->head !== null) {

            //1. if head is not null, create a
            //   temp node pointing to head
            $temp = $this->head;

            //2. move head to next of head
            $this->head = $this->head->next;

            //3. delete temp node
            $temp = null;

            //4. If the new head is not null, then
            //   make prev of the new head as null
            if($this->head !== null){
                $this->head->prev = null;
            }
        }

    }

    public function pop_back() {
        if($this->head !== null) {

            // 1. if head in not null and next of head
            //   is null, release the head
            if($this->head->next === null) {
                $this->head = null;
            } else {

                //2. Else, traverse to the second last
                //   element of the list
                $temp = new Node();
                $temp = $this->head;
                while($temp->next->next !== null){
                    $temp = $temp->next;
                }

                // 3. Change the next of the second
                //   last node to null and delete the
                //   last node
                $lastNode = $temp->next;
                $temp->next = null;
                $lastNode = null;
            }
        }
    }
};

// test the code
//create an empty LinkedList
$MyList = new LinkedList();

//Add first node.
$first = new Node();
$first->data = 10;
$first->next = null;
$first->prev = null;
//linking with head node
$MyList->head = $first;

//Add second node.
$second = new Node();
$second->data = 20;
$second->next = null;
//linking with first node
$second->prev = $first;
$first->next = $second;

//Add third node.
$third = new Node();
$third->data = 30;
$third->next = null;
//linking with second node
$third->prev = $second;
$second->next = $third;

$MyList->printList();

// insert at beginning
//Add three elements at the start of the list.
$MyList->push_front(10);
$MyList->push_front(20);
$MyList->push_front(30);
$MyList->printList();

//Add three elements at the end of the list.
$MyList->push_back(10);
$MyList->push_back(20);
$MyList->push_back(30);
$MyList->printList();

//Insert an element at position 2
$MyList->push_at(100, 2);
$MyList->printList();

//Insert an element at position 1
$MyList->push_at(200, 1);
$MyList->printList();

//Delete the first node
$MyList->pop_front();
$MyList->printList();

//Delete the last node
$MyList->pop_back();
$MyList->printList();

?>
