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

    public function getCoverPage($filter){

        $coverURL = PHY_JOURNALS_METADATA_URL;
        $coverURL .= (isset($filter['journalID'])) ? $filter['journalID'] . '/' : '';
        $coverURL .= (isset($filter['volume'])) ? $filter['volume'] . '/' : '';
        $coverURL .= (isset($filter['issue'])) ? $filter['issue'] . '/' : '01/';
        $coverURL .= 'cover.jpg';

        return str_replace(PHY_JOURNALS_METADATA_URL, JOURNALS_METADATA_URL, $coverURL);
        // return (file_exists($coverURL)) ? str_replace(PHY_JOURNALS_METADATA_URL, JOURNALS_METADATA_URL, $coverURL) : IMAGE_URL . 'generic-cover.jpg';
    }

    public function getStructurePageTitle($filter){

        $pageTitle = NAV_ARCHIVE_VOLUME;
        if(isset($filter['journal'])) unset($filter['journal']);
        foreach ($filter as $key => $value) {

            $pageTitle .= ' > ' . constant('ARCHIVE_' . strtoupper($key)) . ' ' . $this->roman2Devnagari($this->rlZero($value));
        }

        $pageTitle = preg_replace('/^' . NAV_ARCHIVE_VOLUME . ' > /', '', $pageTitle);

        return $pageTitle;
    }

    public function roman2Devnagari($vid)
    {
        $vid = preg_replace("/0/", "०", $vid);
        $vid = preg_replace("/0/", "०", $vid);
        $vid = preg_replace("/1/", "१", $vid);
        $vid = preg_replace("/2/", "२", $vid);
        $vid = preg_replace("/3/", "३", $vid);
        $vid = preg_replace("/4/", "४", $vid);
        $vid = preg_replace("/5/", "५", $vid);
        $vid = preg_replace("/6/", "६", $vid);
        $vid = preg_replace("/7/", "७", $vid);
        $vid = preg_replace("/8/", "८", $vid);
        $vid = preg_replace("/9/", "९", $vid);
        $vid = preg_replace('/^specialA$/i', 'विशेषाङ्कः', $vid);
        $vid = preg_replace('/^specialB$/i', 'विशेषाङ्कः', $vid);
        $vid = preg_replace('/^special$/i', 'विशेषाङ्कः', $vid);

        return($vid);
    }

    public function rlZero($term) {

        $term = preg_replace('/^0+/', '', $term);
        $term = preg_replace('/\-0+/', '-', $term);
        return $term;
    }

    public function getDisplayName($filter){

        $displayString = '';

        foreach ($filter as $key => $value) {

            if(!preg_match('/.*supplement.*/i', $value))    $displayString .= constant('ARCHIVE_' . strtoupper($key)) . ' ';
            $displayString .= ($key == 'month') ?  $this->getMonthDevanagari($value) : $this->roman2Devnagari($this->rlZero($value));
        }

        return $displayString;
    }

    public function getMonthDevanagari($month)
    {
        $month = preg_replace('/^special[AB]*/i', 'विशेषाङ्कः', $month);

        $month = preg_replace('/01/', 'जनवरी', $month);
        $month = preg_replace('/02/', 'फेब्रवरी', $month);
        $month = preg_replace('/03/', 'मार्च्', $month);
        $month = preg_replace('/04/', 'एप्रिल्', $month);
        $month = preg_replace('/05/', 'मे', $month);
        $month = preg_replace('/06/', 'जून्', $month);
        $month = preg_replace('/07/', 'जुलै', $month);
        $month = preg_replace('/08/', 'अगस्ट्', $month);
        $month = preg_replace('/09/', 'सप्टम्बर्', $month);
        $month = preg_replace('/10/', 'अक्टोबर्', $month);
        $month = preg_replace('/11/', 'नवम्बर्', $month);
        $month = preg_replace('/12/', 'डिसेम्बर्', $month);

        return $month;
    }

    public function getIssueDevanagari($issue)
    {
        $issue = preg_replace("/^0/", "", $issue);
        $issue = preg_replace("/0/", "०", $issue);
        $issue = preg_replace("/0/", "०", $issue);
        $issue = preg_replace("/1/", "१", $issue);
        $issue = preg_replace("/2/", "२", $issue);
        $issue = preg_replace("/3/", "३", $issue);
        $issue = preg_replace("/4/", "४", $issue);
        $issue = preg_replace("/5/", "५", $issue);
        $issue = preg_replace("/6/", "६", $issue);
        $issue = preg_replace("/7/", "७", $issue);
        $issue = preg_replace("/8/", "८", $issue);
        $issue = preg_replace("/9/", "९", $issue);
        $issue = preg_replace('/.*supplement.*/i', 'विशेषाङ्कः', $issue);
        $issue = preg_replace('/.*supplement.*/i', 'विशेषाङ्कः', $issue);
        $issue = preg_replace('/.*supplement.*/i', 'विशेषाङ्कः', $issue);

        return $issue;
    }

    public function roman2dev($text) {

        $text = str_replace(" 0", "", strval($text));
        $text = str_replace("0", "०", strval($text));
        $text = str_replace("1", "१", strval($text));
        $text = str_replace("2", "२", strval($text));
        $text = str_replace("3", "३", strval($text));
        $text = str_replace("4", "४", strval($text));
        $text = str_replace("5", "५", strval($text));
        $text = str_replace("6", "६", strval($text));
        $text = str_replace("7", "७", strval($text));
        $text = str_replace("8", "८", strval($text));
        $text = str_replace("9", "९", strval($text));

        return $text;
    }

}

?>
