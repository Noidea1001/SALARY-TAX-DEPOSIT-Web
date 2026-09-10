<?php 
if(!defined('PAGE_TITLE')) { include_once 'common.php'; } 

$grossSalary = '';
$childCount = '';
$hasSpouse = false;
$showResult = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['btncancel'])) {
        header("Location: index.php?page=salary_tax");
        exit();
    }

    $grossSalary = isset($_POST['gross_salary']) && $_POST['gross_salary'] !== '' ? floatval($_POST['gross_salary']) : 0;
    $childCount = isset($_POST['child_count']) && $_POST['child_count'] !== '' ? intval($_POST['child_count']) : 0;
    $hasSpouse = isset($_POST['has_spouse']) && $_POST['has_spouse'] == '1' ? true : false;
    
    if ($childCount > 5) { $childCount = 5; }
    if ($childCount < 0) { $childCount = 0; }

    $allowance_child = $childCount * 150000;
    $allowance_spouse = $hasSpouse ? 150000 : 0;
    $bonus_total = $allowance_child + $allowance_spouse;
    
    $grossSalaryTax = $grossSalary - $bonus_total;
    if ($grossSalaryTax < 0) { $grossSalaryTax = 0; }

    if ($grossSalaryTax <= 1500000) {
        $taxRate = 0.00;
        $payback = 0;
    } elseif ($grossSalaryTax <= 2000000) {
        $taxRate = 0.05;
        $payback = 75000;
    } elseif ($grossSalaryTax <= 8500000) {
        $taxRate = 0.10;
        $payback = 172500;
    } elseif ($grossSalaryTax <= 12500000) {
        $taxRate = 0.15;
        $payback = 600000;
    } else {
        $taxRate = 0.20;
        $payback = 1225000;
    }

    $tax = ($grossSalaryTax * $taxRate) - $payback;
    if ($tax < 0) { $tax = 0; }
    
    $netSalary = $grossSalary - $tax;
    $showResult = true;
}
?>

<h2><?php echo $lang['TAX_CALC_TITLE']; ?></h2>

<form action="index.php?page=salary_tax" method="POST">
    <div class="form-group">
        <label><?php echo $lang['GROSS_SALARY']; ?>:</label>
        <div class="grid-cell">
            <input type="number" name="gross_salary" value="<?php echo $grossSalary; ?>" required>
        </div>
    </div>
    <div class="form-group">
        <label><?php echo $lang['CHILDREN']; ?> (Max: 5):</label>
        <div class="grid-cell">
            <input type="number" name="child_count" value="<?php echo $childCount; ?>" min="0" max="5" required>
        </div>
    </div>
    <div class="form-group">
        <label><?php echo $lang['SPOUSE']; ?>:</label>
        <div class="grid-cell">
            <select name="has_spouse">
                <option value="0" <?php if(!$hasSpouse) echo 'selected'; ?>><?php echo $lang['NO']; ?></option>
                <option value="1" <?php if($hasSpouse) echo 'selected'; ?>><?php echo $lang['YES']; ?></option>
            </select>
        </div>
    </div>

    <div style="grid-column: span 2; padding: 10px; border-right: 1px solid var(--border-gray); border-bottom: 1px solid var(--border-gray); background-color: var(--header-bg); text-align: left; display: flex; gap: 10px;">
        <button type="submit" class="btn-submit" style="margin: 0;"><?php echo $lang['CALCULATE']; ?></button>
        <button type="submit" name="btncancel" class="btn-submit" style="margin: 0; background-color: #a0a0a0; border-color: #808080;" formnovalidate>Cancel</button>
    </div>
</form>

<?php if ($showResult): ?>
<div class="result" style="margin-bottom: 30px;">
    <div class="result-row">
        <span class="result-label"><?php echo $lang['TAX_AMOUNT']; ?>:</span>
        <span class="result-value"><?php echo number_format($tax, 2); ?> R</span>
    </div>
    <div class="result-row">
        <span class="result-label"><?php echo $lang['NET_SALARY']; ?>:</span>
        <span class="result-value"><?php echo number_format($netSalary, 2); ?> R</span>
    </div>
</div>
<?php endif; ?>

<h3><?php echo $lang['TAX_CONDITION_TITLE']; ?></h3>
<div class="result" style="margin-bottom: 15px; grid-template-columns: 250px 120px 1fr;">
    

    <span class="result-label" style="font-weight: 600; text-align: center; justify-content: center; background-color: #edebe9; border-right: 1px solid var(--border-gray);"><?php echo $lang['CONDITION_GROSS_SALARY']; ?></span>
    <span class="result-label" style="font-weight: 600; text-align: center; justify-content: center; background-color: #edebe9; border-right: 1px solid var(--border-gray);"><?php echo $lang['CONDITION_TAX_RATE']; ?></span>
    <span class="result-value" style="font-weight: 600; text-align: center; justify-content: center; background-color: #edebe9; color: var(--text-main); font-family: inherit;"><?php echo $lang['CONDITION_PAYBACK']; ?></span>

    <span class="result-label" style="border-right: 1px solid var(--border-gray);">0R - 1,500,000R</span>
    <span class="result-label" style="text-align: center; justify-content: center; border-right: 1px solid var(--border-gray);">0%</span>
    <span class="result-value">0R</span>
    <span class="result-label" style="border-right: 1px solid var(--border-gray);">1,500,001R - 2,000,000R</span>
    <span class="result-label" style="text-align: center; justify-content: center; border-right: 1px solid var(--border-gray);">5%</span>
    <span class="result-value">75,000R</span>
    <span class="result-label" style="border-right: 1px solid var(--border-gray);">2,000,001R - 8,500,000R</span>
    <span class="result-label" style="text-align: center; justify-content: center; border-right: 1px solid var(--border-gray);">10%</span>
    <span class="result-value">172,500R</span>

    <span class="result-label" style="border-right: 1px solid var(--border-gray);">8,500,001R - 12,500,000R</span>
    <span class="result-label" style="text-align: center; justify-content: center; border-right: 1px solid var(--border-gray);">15%</span>
    <span class="result-value">600,000R</span>

    <span class="result-label" style="border-right: 1px solid var(--border-gray);">12,500,001R <?php echo $lang['CONDITION_UP']; ?></span>
    <span class="result-label" style="text-align: center; justify-content: center; border-right: 1px solid var(--border-gray);">20%</span>
    <span class="result-value">1,225,000R</span>

    <div style="grid-column: span 3; padding: 12px 14px; border-right: 1px solid var(--border-gray); border-bottom: 1px solid var(--border-gray); background-color: var(--header-bg); font-size: 13px; color: var(--text-muted);">
        <?php echo $lang['CONDITION_NOTE']; ?>
    </div>
</div>

</div>
