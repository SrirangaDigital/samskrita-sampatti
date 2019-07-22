<?php

class viewHelper extends View {

    public function __construct() {

    }

    
    public function isLoggedIn() {

        $isLoggedIn = false;
        
        if(isset($_SESSION['auth_logged_in']))
            if($_SESSION['auth_logged_in'])
                $isLoggedIn = true;

        return $isLoggedIn;
    }

    public function isLoggedInAsAdmin() {

        if($this->isLoggedIn())
            if (array_search('ADMIN', $_SESSION['auth_roles_assigned']) !== false)
                return true;

        return false;
    }

    public function printIcon() {

        if($this->isLoggedInAsAdmin())
            echo $this->printAdminIcon();

        elseif($this->isLoggedIn())
            echo $this->printUserIcon();
    }
    
    public function printUserIcon() {

        $fName = $_SESSION['fellow_fname'];
        $lName = $_SESSION['fellow_lname'];
        $initials = '';
        
        if ($fName) $initials .= $fName[0];
        if ($lName) $initials .= $lName[0];

        $html = '
            <ul class="navbar-nav" id="user">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div id="user-icon" width="50" height="50">' . $initials . '</div>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item"><strong>' . $_SESSION['fellow_dname'] . '</strong></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="' . BASE_URL . 'profile/v/' . $_SESSION['auth_username'] . '">View Profile</a>
                        <a class="dropdown-item" href="' . BASE_URL . 'profile/e/' . $_SESSION['auth_username'] . '">Edit Profile</a>
                        <a class="dropdown-item" href="' . BASE_URL . 'profile/changePassword">Change Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="' . SPRINGERLINK_URL . '" target="_blank">Access SpringerLink</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="' . BASE_URL . 'profile/logout">Logout</a>
                    </div>
                </li>
            </ul>';
        return $html;
    }

    public function printAdminIcon() {

        $initials = 'A';
        
        $html = '
            <ul class="navbar-nav" id="user">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div id="user-icon" width="50" height="50">' . $initials . '</div>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item"><strong>Admin</strong></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="' . SPRINGERLINK_URL . '" target="_blank">Access SpringerLink</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="' . BASE_URL . 'profile/logout">Logout</a>
                    </div>
                </li>
            </ul>';
        return $html;
    }

    public function displayContents($bookID, $data) {
        
        $displayString = '';
        $data = preg_split('/\n/', $data);

        foreach ($data as $line) {

            if(preg_match('/<li data-page="(.*?)">(.*)/', $line, $matches)){

                $matches[2] = preg_replace('/<\/li>$/', '', $matches[2]);
                $displayString .= '<li><a href="' . BASE_URL . 'bookreader/templates/book.php?bookID=' . $bookID . '&pagenum=' . $matches[1] . '" target="_blank">' . $matches[2] . '</a></li>';
            }
            else{
                $displayString .= $line;   
            }
        }

        return $displayString;
    }    
}

?>
