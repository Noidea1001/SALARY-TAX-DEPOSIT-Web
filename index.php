<?php 
include_once 'common.php';

$allowed_pages = ['home', 'salary_tax', 'deposit'];
$page = 'home'; 

if (isset($_GET['page'])) {
    $clean_page = $_GET['page'];
    if (in_array($clean_page, $allowed_pages)) {
        $page = $clean_page;
    }
}
$_SESSION['page'] = $page;


switch($page) {
    case 'salary_tax':
        $page_title = $lang['MENU_SALARY_TAX']; 
        break;
    case 'deposit':
        $page_title = $lang['MENU_DEPOSIT'];    
        break;
    case 'home':
    default:
        $page_title = $lang['MENU_HOME'];      
        break;
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
  
    <title><?php echo $page_title; ?> - <?php echo $lang['PAGE_TITLE']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="OuterFrmDl">
    <div id="HeadSectionDl">
        <div id="WSTitleDL"><?php echo $lang['HEADER_TITLE']; ?></div>
        <div id="WSubTitleDL"><?php echo $lang['SLOGAN']; ?></div>
        <div id="languages">
            <a href="index.php?page=<?php echo $_SESSION['page']; ?>&lang=en">
                <img src="https://upload.wikimedia.org/wikipedia/commons/8/83/Flag_of_the_United_Kingdom_%283-5%29.svg?utm_source=commons.wikimedia.org&utm_campaign=index&utm_content=original" alt="English"/>
            </a>
            <a href="index.php?page=<?php echo $_SESSION['page']; ?>&lang=kh">
                <img src="https://cdn.britannica.com/27/4027-050-15A75C70/Flag-Cambodia.jpg" alt="Khmer"/>
            </a>
        </div>
    </div>
    
    <div id="MainAppBody">
        <div id="SidebarNavSectionDl">
            <ul>
                <li class="<?php if($page == 'home') echo 'active'; ?>">
                    <a href="index.php?page=home"><?php echo $lang['MENU_HOME']; ?></a>
                </li>
                <li class="<?php if($page == 'salary_tax') echo 'active'; ?>">
                    <a href="index.php?page=salary_tax"><?php echo $lang['MENU_SALARY_TAX']; ?></a>
                </li>
                <li class="<?php if($page == 'deposit') echo 'active'; ?>">
                    <a href="index.php?page=deposit"><?php echo $lang['MENU_DEPOSIT']; ?></a>
                </li>
            </ul>
        </div>
        
        <div id="CntSectionDlDiv">
            <div class="ContentBoxDl">
                <?php 
                switch($page) {
                    case "home":
                        include("home.php");
                        break;
                    case "salary_tax":
                        include("salary_tax.php");
                        break;
                    case "deposit":
                        include("deposit.php");
                        break;
                    default:
                        include("home.php");
                }
                ?>
            </div>
        </div>
    </div>
    
    <div id="FooterBxDL">
        <p>&copy;<?php echo $lang['COPYRIGHT'] ; ?></p>
    </div>
</div>
</body>
</html>
