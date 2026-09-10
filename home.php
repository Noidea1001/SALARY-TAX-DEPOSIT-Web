<?php 
if(!defined('PAGE_TITLE')) { include_once 'common.php'; } 

$showRegResult = false;
$firstname = "";
$lastname = "";
$username = "";
$email = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['btncancel'])) {
        header("Location: index.php?page=home");
        exit();
    }

    if (isset($_POST['firstname'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
     
        $showRegResult = true;
    }
}
?>

<h2><?php echo $lang['MENU_HOME']; ?></h2>
<p><?php echo $lang['DEPOSIT_DESC']; ?></p>

<div style="margin: 20px 0; text-align: center;">
    <img src="images/5bbc4a7e11bb7-removebg-preview.png" alt="STEP Institute" style="max-width: 100%; height: auto;">
</div>

<h3><?php echo $lang['REG_FORM']; ?></h3>

<form action="index.php?page=home" method="POST">
    <div class="form-group">
        <label><?php echo $lang['FIRST_NAME']; ?>:</label>
        <div class="grid-cell">
            <input type="text" name="firstname" value="<?php echo $firstname; ?>" required>
        </div>
    </div>
    <div class="form-group">
        <label><?php echo $lang['LAST_NAME']; ?>:</label>
        <div class="grid-cell">
            <input type="text" name="lastname" value="<?php echo $lastname; ?>" required>
        </div>
    </div>
    <div class="form-group">
        <label><?php echo $lang['USERNAME']; ?>:</label>
        <div class="grid-cell">
            <input type="text" name="username" value="<?php echo $username; ?>" required>
        </div>
    </div>
    <div class="form-group">
        <label><?php echo $lang['PASSWORD']; ?>:</label>
        <div class="grid-cell">
            <input type="password" name="password" required>
        </div>
    </div>
    <div class="form-group">
        <label><?php echo $lang['EMAIL']; ?>:</label>
        <div class="grid-cell">
            <input type="email" name="email" value="<?php echo $email; ?>" required>
        </div>
    </div>

    <div style="grid-column: span 2; padding: 10px; border-right: 1px solid var(--border-gray); border-bottom: 1px solid var(--border-gray); background-color: var(--header-bg); text-align: left; display: flex; gap: 10px;">
        <button type="submit" class="btn-submit" style="margin: 0;"><?php echo $lang['SUBMIT']; ?></button>
        <button type="submit" name="btncancel" class="btn-submit" style="margin: 0; background-color: #a0a0a0; border-color: #808080;" formnovalidate>Cancel</button>
    </div>
</form>

<?php if ($showRegResult){ ?>
<div class="result">
    <div class="result-row">
        <span class="result-label">Full Name:</span>
        <span class="result-value" style="text-align: left; font-family: inherit;"><?php echo $lastname . " " . $firstname; ?></span>
    </div>
    <div class="result-row">
        <span class="result-label">Username:</span>
        <span class="result-value" style="text-align: left; font-family: inherit;"><?php echo $username; ?></span>
    </div>
    <div class="result-row">
        <span class="result-label">Email Address:</span>
        <span class="result-value" style="text-align: left; font-family: inherit;"><?php echo $email; ?></span>
    </div>
    <div class="result-row">
        <span class="result-label">Status:</span>
        <span class="result-value" style="text-align: left; font-family: inherit; color: var(--excel-green); font-weight: bold;">Success (ចុះឈ្មោះជោគជ័យ)</span>
    </div>
</div>
<?php } ?>
