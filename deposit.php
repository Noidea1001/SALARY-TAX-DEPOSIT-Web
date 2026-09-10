<?php
if(!defined('PAGE_TITLE')) { include_once 'common.php'; }

$showResult = false;
$deposit = '';
$currency = '';
$duration = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['btncancel'])) {
        header("Location: index.php?page=deposit");
        exit();
    }

    if (isset($_POST["btnok"])) {
        $deposit = $_POST["deposit"];
        $currency = $_POST["currency"];
        $duration = $_POST["duration"];

        $interestRate = 0;
        $currencyType = "";
        $durationMonths = 12;

        if ($currency == 1) {
            $currencyType = "R";
        } elseif ($currency == 2) {
            $currencyType = "$";
        } elseif ($currency == 3) {
            $currencyType = "Y";
        }

        if ($duration == 1) {
            $interestRate = 0.035;
            $durationMonths = 12;
        } elseif ($duration == 2) {
            $interestRate = 0.04;
            $durationMonths = 24;
        } elseif ($duration == 3) {
            $interestRate = 0.045;
            $durationMonths = 36;
        } elseif ($duration == 4) {
            $interestRate = 0.0675;
            $durationMonths = 48;
        }

        $interest = ($deposit * $interestRate) - (($deposit * $interestRate) * 0.06); 
        $totalMoney = $deposit + $interest; 
        $monthlyInterest = $interest / $durationMonths;
        
        $showResult = true;
    }
}
?>

<h2><?php echo $lang['DEPOSIT_TITLE']; ?></h2>

<form method="POST" action="index.php?page=deposit">
    <div class="form-group">
        <label>Deposit:</label>
        <div class="grid-cell">
            <input type="number" name="deposit" value="<?php echo $deposit; ?>" placeholder="Enter deposit amount" min="1" step="0.01" required>
        </div>
    </div>

    <div class="form-group">
        <label>Currency:</label>
        <div class="grid-cell">
            <select name="currency" required>
                <option value="">-- Select Currency --</option>
                <option value="1" <?php if($currency == 1) echo 'selected'; ?>> 1. Riel </option>
                <option value="2" <?php if($currency == 2) echo 'selected'; ?>> 2. Dollar</option>
                <option value="3" <?php if($currency == 3) echo 'selected'; ?>> 3. Yuan</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label>Duration:</label>
        <div class="grid-cell">
            <select name="duration" required>
                <option value="">-- Select Duration --</option>
                <option value="1" <?php if($duration == 1) echo 'selected'; ?>> 1. 12 months </option>
                <option value="2" <?php if($duration == 2) echo 'selected'; ?>> 2. 24 months</option>
                <option value="3" <?php if($duration == 3) echo 'selected'; ?>> 3. 36 months</option>
                <option value="4" <?php if($duration == 4) echo 'selected'; ?>> 4. 48 months</option>
            </select>
        </div>
    </div>

    <div style="grid-column: span 2; padding: 10px; border-right: 1px solid var(--border-gray); border-bottom: 1px solid var(--border-gray); background-color: var(--header-bg); text-align: left; display: flex; gap: 10px;">
        <button type="submit" name="btnok" class="btn-submit" style="margin: 0;"> OK </button>
        <button type="submit" name="btncancel" class="btn-submit" style="margin: 0; background-color: #a0a0a0; border-color: #808080;" formnovalidate>Cancel</button>
    </div>
</form>

<?php if($showResult){ ?>
<div class="result" style="margin-bottom: 30px;">
    <div class="result-row">
        <span class="result-label">Deposit:</span>
        <span class="result-value"><?php echo number_format($deposit, 2) . $currencyType; ?></span>
    </div>
    <div class="result-row">
        <span class="result-label">Interest:</span>
        <span class="result-value"><?php echo number_format($interest, 2) . $currencyType; ?></span>
    </div>
    <div class="result-row">
        <span class="result-label">Total Money:</span>
        <span class="result-value"><?php echo number_format($totalMoney, 2) . $currencyType; ?></span>
    </div>
    <div class="result-row">
        <span class="result-label">Monthly Interest:</span>
        <span class="result-value"><?php echo number_format($monthlyInterest, 2) . $currencyType; ?></span>
    </div>
</div>
<?php } ?>

<h3><?php echo $lang['DEPOSIT_CONDITION_TITLE']; ?></h3>
<div class="result" style="margin-bottom: 15px; grid-template-columns: 200px 120px 120px 1fr;">
    
    <span class="result-label" style="font-weight: 600; text-align: center; justify-content: center; background-color: #edebe9; border-right: 1px solid var(--border-gray);"><?php echo $lang['CONDITION_DURATION']; ?></span>
    <span class="result-label" style="font-weight: 600; text-align: center; justify-content: center; background-color: #edebe9; border-right: 1px solid var(--border-gray);"><?php echo $lang['CONDITION_RIEL']; ?></span>
    <span class="result-label" style="font-weight: 600; text-align: center; justify-content: center; background-color: #edebe9; border-right: 1px solid var(--border-gray);"><?php echo $lang['CONDITION_DOLLAR']; ?></span>
    <span class="result-value" style="font-weight: 600; text-align: center; justify-content: center; background-color: #edebe9; color: var(--text-main); font-family: inherit;"><?php echo $lang['CONDITION_YUAN']; ?></span>

    <span class="result-label" style="border-right: 1px solid var(--border-gray);">12 months</span>
    <span class="result-label" style="text-align: center; justify-content: center; border-right: 1px solid var(--border-gray);">3.5%</span>
    <span class="result-label" style="text-align: center; justify-content: center; border-right: 1px solid var(--border-gray);">3.5%</span>
    <span class="result-value" style="text-align: center; justify-content: center;">3.5%</span>

    <span class="result-label" style="border-right: 1px solid var(--border-gray);">24 months</span>
    <span class="result-label" style="text-align: center; justify-content: center; border-right: 1px solid var(--border-gray);">4%</span>
    <span class="result-label" style="text-align: center; justify-content: center; border-right: 1px solid var(--border-gray);">4%</span>
    <span class="result-value" style="text-align: center; justify-content: center;">4%</span>

    <span class="result-label" style="border-right: 1px solid var(--border-gray);">36 months</span>
    <span class="result-label" style="text-align: center; justify-content: center; border-right: 1px solid var(--border-gray);">4.5%</span>
    <span class="result-label" style="text-align: center; justify-content: center; border-right: 1px solid var(--border-gray);">4.5%</span>
    <span class="result-value" style="text-align: center; justify-content: center;">4.5%</span>

    <span class="result-label" style="border-right: 1px solid var(--border-gray);">48 months</span>
    <span class="result-label" style="text-align: center; justify-content: center; border-right: 1px solid var(--border-gray);">6.75%</span>
    <span class="result-label" style="text-align: center; justify-content: center; border-right: 1px solid var(--border-gray);">6.75%</span>
    <span class="result-value" style="text-align: center; justify-content: center;">6.75%</span>
    <div style="grid-column: span 4; padding: 12px 14px; border-right: 1px solid var(--border-gray); border-bottom: 1px solid var(--border-gray); background-color: var(--header-bg); font-size: 13px; color: var(--text-muted);">
        <?php echo $lang['DEPOSIT_NOTE']; ?>
    </div>
</div>
