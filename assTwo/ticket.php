<?php
class Ticket {
    // Properties
    private $id;
    private $customerName;
    private $description;
    private $submittedDate;
    private $status;
    private $emergencyLevel;
    private $assignedDate;
    private $assignedStaff;
    private $photoUrl;

    // Constructor
    public function __construct($id, $customerName, $description, $submittedDate, $status, $emergencyLevel, $assignedDate, $assignedStaff, $photoUrl) {
        $this->id = $id;
        $this->customerName = $customerName;
        $this->description = $description;
        $this->submittedDate = $submittedDate;
        $this->status = $status;
        $this->emergencyLevel = $emergencyLevel;
        $this->assignedDate = $assignedDate;
        $this->assignedStaff = $assignedStaff;
        $this->photoUrl = $photoUrl;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getCustomerName() {
        return $this->customerName;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getSubmittedDate() {
        return $this->submittedDate;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getEmergencyLevel() {
        return $this->emergencyLevel;
    }

    public function getAssignedDate() {
        return $this->assignedDate;
    }

    public function getAssignedStaff() {
        return $this->assignedStaff;
    }

    public function getPhotoUrl() {
        return $this->photoUrl;
    }

    // Display as HTML table row
    public function displayTableRow() {
        return "
        <tr>
            <td>{$this->id}</td>
            <td>{$this->customerName}</td>
            <td>{$this->description}</td>
            <td>{$this->submittedDate}</td>
            <td>{$this->status}</td>
            <td>{$this->emergencyLevel}</td>
            <td>{$this->assignedDate}</td>
            <td>{$this->assignedStaff}</td>
            <td><img src='{$this->photoUrl}' alt='Ticket Photo' width='50'></td>
        </tr>
        ";
    }

    // Display as detailed HTML section
    public function displayTicketDetails() {
        return "
        <ul>
            <li><strong>Ticket ID:</strong> {$this->id}</li>
            <li><strong>Submitted by Customer:</strong> {$this->customerName}</li>
            <li><strong>Description:</strong> {$this->description}</li>
            <li><strong>Submitted Date:</strong> {$this->submittedDate}</li>
            <li><strong>Status:</strong> {$this->status}</li>
            <li><strong>Emergency Level:</strong> {$this->emergencyLevel}</li>
            <li><strong>Assigned Date:</strong> {$this->assignedDate}</li>
            <li><strong>Assigned Staff:</strong> {$this->assignedStaff}</li>
            <li><strong>Photo:</strong><br>
                <img src='{$this->photoUrl}' alt='Ticket Photo' width='300'>
            </li>
        </ul>
        ";
    }
}
?>
