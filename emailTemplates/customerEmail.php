<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head></head>
<body>
<?php
    //!empty($_SESSION['backendEmail']) ?: die('<p>No email address input. No mail will be sent.');
    $numberOfScreens = isset($_SESSION['boxFace']) ? count($_SESSION['boxFace']) : 0; // number of screens
    //echo '<h1>' . $numberOfScreens . '</h1>';
    $date = new DateTime();
    $date->setTimezone(new DateTimeZone('America/Vancouver'));
?>

<div style="text-align:center; margin:50px 0px 50px 0px;"><img style="-webkit-user-select: none;" class="img-fluid" src="[AA].png" alt="[AA]"></div>
<div class="content" style="font-family: Verdana">
    <div class="customerInfo" style="margin-bottom:25px;">
        <p style="margin:5px 5px 15px 5px; font-style:italic;"><?= $date->format('F d, Y'); ?></p>
        <p style="margin:5px;"><b>Attention: <?= $_SESSION['customerName'][0]?></b></p>
        <p style="margin:5px;"><?= $_SESSION['customerAddress'][0] . ', ' . $_SESSION['customerCity'][0]; ?></p>
        <p style="margin:5px;"><?= $_SESSION['customerPhone'][0]; ?></p>
        <p style="margin:5px;"><?= $_SESSION['customerEmail'][0]; ?></p>
        <p style="margin:15px 5px 15px 5px;">Quote ID: <?= $_SESSION['quoteID'] ?></p>
    </div>

    <div class="disclaimer">
        <p style="margin:5px 5px 15px 5px;">The price quoted includes all materials and labor for the quote requested.</p>
    </div>
    <?php
    for($i=0; $i<$_SESSION['numberOfAwnings']; $i++){
        echo    '<span style="text-decoration: underline;"><h4 style="margin:5px;"><b>Awning ' . ($_SESSION['numberOfAwnings'] > 1 ? ($i+1) : '') . '</b></h4></span>' .
                '<p style="margin:5px;"><b>Style:</b> ' . $_SESSION['awningStyle'][$i] . '</p>' .
                '<p style="margin:5px;"><b>Hood Cover:</b> ' . $_SESSION['awningHoodCover'][$i] . '</p>' .
                '<p style="margin:5px;"><b>Size:</b> ' .    (!empty($_SESSION['awningHeightFeet'][$i]) ? $_SESSION['awningHeightFeet'][$i] . '\' ' : "") .
                                                            (!empty($_SESSION['awningHeightInches'][$i]) ? $_SESSION['awningHeightInches'][$i] . '"' : "") .
                                                            (!empty($_SESSION['awningHeightFeet'][$i]) || !empty($_SESSION['awningHeightInches'][$i]) ? ' x ' : "") .
                                                            (!empty($_SESSION['awningWidthFeet'][$i]) ? $_SESSION['awningWidthFeet'][$i] . '\' ' : "") .
                                                            (!empty($_SESSION['awningWidthInches'][$i]) ? $_SESSION['awningWidthInches'][$i] . '"' : "") . '</p>';
        echo    '<p style="margin:5px;"><b>Projection:</b> ' .  (!empty($_SESSION['awningProjectionFeet'][$i]) ? $_SESSION['awningProjectionFeet'][$i] . '\' ' : "") .
                                                                (!empty($_SESSION['awningProjectionInches'][$i]) ? $_SESSION['awningProjectionInches'][$i] . '"' : "") . '</p>';
        echo    '<p style="margin:5px;"><b>Operation:</b> ' . $_SESSION['awningOperation'][$i] . '</p>';
        if(isset($_SESSION['awningOperation'][$i]) && $_SESSION['awningOperation'][$i] === 'Motor'){
            echo    '<p style="margin:5px;"><b>Remote Type:</b> ' . $_SESSION['awningRemote'][$i] . '</p>' .
                    '<p style="margin:5px;"><b>Wind Sensor:</b> ' . $_SESSION['awningWindSensor'][$i] . '</p>';
        }
        if(isset($_SESSION['awningFrameColor'][$i]) && $_SESSION['awningFrameColor'][$i] !== 'Custom'){
            echo    '<p style="margin:5px;"><b>Frame Color:</b> ' . $_SESSION['awningFrameColor'][$i] . '</p>';
        }
        if(!empty($_SESSION['awningCustomColor'][$i])){
            echo    '<p style="margin:5px;"><b>Frame Color:</b> ' . $_SESSION['awningFrameColor'][$i] . ' (custom)</p>';
        }
        echo    '<p style="margin:5px;"><b>Fabric Color:</b> ' . $_SESSION['awningFabric'][$i] . '</p>' .
                '<p style="margin:5px;"><b>Valance:</b> ' . $_SESSION['awningValance'][$i] . '</p>';

        // count how many prices quoted, if more than one, include total at bottom.
        $quotes = 0;
        if(!empty($_SESSION['awningPriceQuote'][$i])){
            echo    '<p style="margin:5px;"><b>Awning Price:</b> $' . number_format($_SESSION['awningPriceQuote'][$i], 2) . '</p>';
            $quotes++;
        }
        if(!empty($_SESSION['awningMotorQuote'][$i])){
            echo    '<p style="margin:5px;"><b>Motor Price:</b> $' . number_format($_SESSION['awningMotorQuote'][$i], 2) . '</p>';
            $quotes++;
        }
        if(!empty($_SESSION['awningBracketQuote'][$i])){
            echo    '<p style="margin:5px;"><b>Bracket Price:</b> $' . number_format($_SESSION['awningBracketQuote'][$i], 2) . '</p>';
            $quotes++;
        }
        if(!empty($_SESSION['awningExtraQuote'][$i])){
            echo    '<p style="margin:5px;"><b>Additional Costs:</b> $' . number_format($_SESSION['awningExtraQuote'][$i], 2) . '</p>';
            $quotes++;
        }
        if($quotes > 1){
            echo    '<p style="margin:5px;"><b>Total:</b> ' . number_format($_SESSION['awningTotal'][$i], 2) . '</p>';
        }
    }
    for($i=0; $i<$_SESSION['numberOfScreens']; $i++){
        echo    '<span style="text-decoration: underline;"><h4 style="margin:5px;"><b>Screen ' . ($_SESSION['numberOfScreens'] > 1 ? ($i+1) : '') . '</b></h4></span>' .
                '<p style="margin:5px;"><b>Type:</b> ' . ($_SESSION['a2'][$i] > 233 ? 'Extreme Screen' : 'Solution Screen') . '</p>' .
                '<p style="margin:5px;"><b>Size:</b> ' . $_SESSION['a2'][$i] . '" x ' . $_SESSION['lb2'][$i] . '"</p>' .
                '<p style="margin:5px;"><b>Operation:</b> ' . $_SESSION['actionType'][$i] . '</p>';
                if(isset($_SESSION['actionType'][$i]) && $_SESSION['actionType'][$i] === 'Motorized'){
                    echo '<p style="margin:5px;"><b>Remote Type:</b> ' . $_SESSION['remoteType'][$i] . '</p>';
                }
        echo    '<p style="margin:5px;"><b>Box Powder Coat Color:</b> ' . $_SESSION['a2PowderColor'][$i] . '</p>';
                if(isset($_SESSION['l2PowderColor'][$i]) && $_SESSION['a2PowderColor'][$i] !== $_SESSION['l2PowderColor'][$i]){
                    echo '<p style="margin:5px;"><b>Left Rail Powder Coat Color:</b> ' . $_SESSION['l2PowderColor'][$i] . '</p>';
                }
                if(isset($_SESSION['r2PowderColor'][$i]) && $_SESSION['a2PowderColor'][$i] !== $_SESSION['r2PowderColor'][$i]){
                    echo '<p style="margin:5px;"><b>Right Rail Powder Coat Color:</b> ' . $_SESSION['r2PowderColor'][$i] . '</p>';
                }
        echo
                '<p style="margin:5px;"><b>Fabric Density:</b> ' . $_SESSION['fabricDensity'][$i] . '</p>' .
                '<p style="margin:5px;"><b>Fabric Color:</b> ' . $_SESSION['fabricColor'][$i] . '</p>';
        // count how many prices quoted, if more than one, include total at bottom.
        $quotes = 0;
        if(!empty($_SESSION['screenPriceQuote'][$i])){
            echo    '<p style="margin:5px;"><b>Screen Price:</b> $' . number_format($_SESSION['screenPriceQuote'][$i], 2) . '</p>';
            $quotes++;
        }
        if(!empty($_SESSION['screenBupQuote'][$i])){
            echo    '<p style="margin:5px;"><b>Build-up Price:</b> $' . number_format($_SESSION['screenBupQuote'][$i], 2) . '</p>';
            $quotes++;
        }
        if(!empty($_SESSION['screenExtraQuote'][$i])){
            echo    '<p style="margin:5px;"><b>Additional Costs:</b> $' . number_format($_SESSION['screenExtraQuote'][$i], 2) . '</p>';
            $quotes++;
        }
        if($quotes > 1){
            echo    '<p style="margin:5px;"><b>Total:</b> ' . number_format($_SESSION['screenTotal'][$i], 2) . '</p>';
        }

    }
    ?>
    <p style="margin:5px;">Applicable taxes are not included.</p>
    <p style="margin:5px;"><b>Warranty: </b> 10 year on all parts, 5 year on labor. Fabric warranty is based on manufacturer’s warranty.</p>
    <p style="margin:5px 5px 15px 5px;"><b>Quotation: </b> This price is valid for 90 days. Goods remain the property of vendor until paid in full.
    50% Deposit is required at the time of order, remaining amount due at time of installation.</p>
    <p style="margin:5px;">Please call or email if you have any questions. If you would like to see the product quoted, please visit one of our showrooms.</p>
    <p style="margin:15px 5px 5px 5px;">[Address 1]</p>
    <p style="margin:5px;">[Address 2]</p>
    <p style="margin:5px;">[Address 3]</p>
    <div style="margin-top:35px;">
        <p style="margin:5px;">Thank You, <?= $_SESSION['salesPerson'] ?></p>
        <p style="margin:5px;">Proudly serving [Area] since [Company Start Year]</p>
    </div>
</div>
</body>
