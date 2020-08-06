<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head></head>
<body>
<h1>Submitted Data</h1>

<span>Quote ID: <?= $_SESSION['quoteID'] ?></span>

<h3>Customer Information</h3>
<ul>
    <li><b>Customer Address:</b> <?=  (!empty($_SESSION['customerAddress'][0]) ? $_SESSION['customerAddress'][0] : "N/A"); ?></li>
    <li><b>Customer City:</b> <?=  (!empty($_SESSION['customerCity'][0]) ? $_SESSION['customerCity'][0] : "N/A"); ?></li>
    <li><b>Customer Email:</b> <?=  (!empty($_SESSION['customerEmail'][0]) ? $_SESSION['customerEmail'][0] : "N/A"); ?></li>
    <li><b>Customer Phone:</b> <?=  (!empty($_SESSION['customerPhone'][0]) ? $_SESSION['customerPhone'][0] : "N/A"); ?></li>
    <li><b>Customer Name:</b> <?= (!empty($_SESSION['customerName'][0]) ? $_SESSION['customerName'][0] : "N/A"); ?></li>
</ul>

<?php

for ($i = 0; $i < $_SESSION['numberOfAwnings']; $i++) {
    echo "<h3>Awning #" . ($i + 1) . "</h3>";
    echo "<ul>";
    echo "<li><b>Awning Style:</b> " . (!empty($_SESSION['awningStyle'][$i]) ? $_SESSION['awningStyle'][$i] : "N/A") . "</li>";
    if(isset($_SESSION['wrapFrontProfile'][$i]) && $_SESSION['wrapFrontProfile'][$i] !== 'N/A'){
        echo "<li><b>Wrap Front Profile:</b> " . $_SESSION['wrapFrontProfile'][$i] . "</li>";
    }
    echo "<li><b>Width:</b> " .     (!empty($_SESSION['awningWidthFeet'][$i]) ? $_SESSION['awningWidthFeet'][$i] . 'ft. ' : "") . 
                                    (!empty($_SESSION['awningWidthInches'][$i]) ? $_SESSION['awningWidthInches'][$i] . 'in.' : "") . "</li>";
    echo "<li><b>Projection:</b> " .   (!empty($_SESSION['awningProjectionInches'][$i]) ? $_SESSION['awningProjectionFeet'][$i] . 'ft. ' : "") . 
                                    (!empty($_SESSION['awningProjectionInches'][$i]) ? $_SESSION['awningProjectionInches'][$i] . 'in.' : "") . "</li>";
    if(!empty($_SESSION['awningHeightFeet'][$i]) || !empty($_SESSION['awningHeightInches'][$i])){
        echo "<li><b>Height:</b> " .    (!empty($_SESSION['awningHeightInches'][$i]) ? $_SESSION['awningHeightFeet'][$i] . 'ft. ' : "") . 
                                        (!empty($_SESSION['awningHeightInches'][$i]) ? $_SESSION['awningHeightInches'][$i] . 'in.' : "") . "</li>";
    }
    if(isset($_SESSION['awningFrameColor'][$i]) && $_SESSION['awningFrameColor'][$i] !== 'Custom'){
        echo "<li><b>Frame Color:</b> " . (!empty($_SESSION['awningFrameColor'][$i]) ? $_SESSION['awningFrameColor'][$i] : "N/A") . "</li>";
    }
    if(!empty($_SESSION['awningCustomColor'][$i])){
        echo "<li><b>Frame Color(Custom):</b> " . $_SESSION['awningCustomColor'][$i] . "</li>";
    }
    echo "<br>";
    echo "<li><b>Operation:</b> " . (!empty($_SESSION['awningOperation'][$i]) ? $_SESSION['awningOperation'][$i] : "N/A") . "</li>";
    if (!empty($_SESSION['awningOperation'][$i]) && $_SESSION['awningOperation'][$i] === 'Motor') {
        echo "<li><b>Motor Type:</b> " . (!empty($_SESSION['awningMotorType'][$i]) ? $_SESSION['awningMotorType'][$i] : "N/A") . "</li>";
        echo "<li><b>Cord Length:</b> " . (!empty($_SESSION['awningCordLength'][$i]) ? $_SESSION['awningCordLength'][$i] : "N/A") . "</li>";
        echo "<li><b>Remote:</b> " . (!empty($_SESSION['awningRemote'][$i]) ? $_SESSION['awningRemote'][$i] : "N/A") . "</li>";
        echo "<li><b>Wind Sensor:</b> " . (!empty($_SESSION['awningWindSensor'][$i]) ? $_SESSION['awningWindSensor'][$i] : "N/A") . "</li>";
    }
    if (!empty($_SESSION['awningOperation'][$i]) && $_SESSION['awningOperation'][$i] === 'Manual') {
        echo "<li><b>Crank Size:</b> " . (!empty($_SESSION['awningCrankSize'][$i]) ? $_SESSION['awningCrankSize'][$i] : "N/A") . "</li>";
    }
    echo "<br>";
    echo "<li><b>Control:</b> " . (!empty($_SESSION['awningControl'][$i]) ? $_SESSION['awningControl'][$i] : "N/A") . "</li>";
    echo "<li><b>Control Notes:</b> " . (!empty($_SESSION['awningControlNotes'][$i]) ? $_SESSION['awningControlNotes'][$i] : "N/A") . "</li>";
    echo "<li><b>Hood Cover:</b> " . (!empty($_SESSION['awningHoodCover'][$i]) ? $_SESSION['awningHoodCover'][$i] : "N/A") . "</li>";
    echo "<li><b>Fabric:</b> " . (!empty($_SESSION['awningFabric'][$i]) ? $_SESSION['awningFabric'][$i] : "N/A") . "</li>";
    echo "<li><b>Valance:</b> " . (!empty($_SESSION['awningValance'][$i]) ? $_SESSION['awningValance'][$i] : "N/A") . "</li>";
    echo "<li><b>Trim:</b> " . (!empty($_SESSION['awningTrim'][$i]) ? $_SESSION['awningTrim'][$i] : "N/A") . "</li>";
    echo "<li><b>Mount:</b> " . (!empty($_SESSION['awningMount'][$i]) ? $_SESSION['awningMount'][$i] : "N/A") . "</li>";
    echo "<li><b>Mount Notes:</b> " . (!empty($_SESSION['awningMountNotes'][$i]) ? $_SESSION['awningMountNotes'][$i] : "N/A") . "</li>";
    echo "<br>";
    echo "<li><b>Brackets:</b> " . (!empty($_SESSION['awningBrackets'][$i]) ? $_SESSION['awningBrackets'][$i] : "N/A") . "</li>";
    if (!empty($_SESSION['awningBrackets'][$i]) && $_SESSION['awningBrackets'][$i] === 'Yes') {
        echo "<li><b>Bracket Type:</b> " . (!empty($_SESSION['awningBracketType'][$i]) ? $_SESSION['awningBracketType'][$i] : "N/A") . "</li>";
        echo "<li><b>Bracket Quantity:</b> " . (!empty($_SESSION['awningBracketQuantity'][$i]) ? $_SESSION['awningBracketQuantity'][$i] : "N/A") . "</li>";
        echo "<li><b>Bracket Color:</b> " . (!empty($_SESSION['awningBracketColor'][$i]) ? $_SESSION['awningBracketColor'][$i] : "N/A") . "</li>";
    }
    echo "<br>";
    echo "<li><b>Placement On House:</b> " . (!empty($_SESSION['awningHousePlacement'][$i]) ? $_SESSION['awningHousePlacement'][$i] : "N/A") . "</li>";
    echo "<li><b>Special Notes:</b> " . (!empty($_SESSION['awningSpecialNotes'][$i]) ? $_SESSION['awningSpecialNotes'][$i] : "N/A") . "</li>";
    echo "<li><b>Awning Quote:</b> " . (!empty($_SESSION['awningPriceQuote'][$i]) ? $_SESSION['awningPriceQuote'][$i] : "N/A") . "</li>";
    echo "<li><b>Motor Quote:</b> " . (!empty($_SESSION['awningMotorQuote'][$i]) ? $_SESSION['awningMotorQuote'][$i] : "N/A") . "</li>";
    echo "<li><b>Bracket Quote:</b> " . (!empty($_SESSION['awningBracketQuote'][$i]) ? $_SESSION['awningBracketQuote'][$i] : "N/A") . "</li>";
    echo "<li><b>Extra Cost Quote:</b> " . (!empty($_SESSION['awningExtraQuote'][$i]) ? $_SESSION['awningExtraQuote'][$i] : "N/A") . "</li>";
    echo "<li><b>Total:</b> " . (!empty($_SESSION['awningTotal'][$i]) ? $_SESSION['awningTotal'][$i] : "N/A") . "</li>";
    echo "</ul>";
}
for ($i = 0; $i < $_SESSION['numberOfScreens']; $i++) {
    echo "<h3>screen #" . ($i + 1) . "</h3>";
    echo "<ul>";
    echo "<li><b>Box Face:</b> " . (!empty($_SESSION['boxFace'][$i]) ? $_SESSION['boxFace'][$i] : "N/A") . "</li>";
    echo "<li><b>Fabric Density:</b> " . (!empty($_SESSION['fabricDensity'][$i]) ? $_SESSION['fabricDensity'][$i] : "N/A") . "</li>";
    echo "<li><b>Fabric Color:</b> " . (!empty($_SESSION['fabricColor'][$i]) ? $_SESSION['fabricColor'][$i] : "N/A") . "</li>";
    echo "<li><b>Dark Side Face:</b> " . (!empty($_SESSION['darkSideFace'][$i]) ? $_SESSION['darkSideFace'][$i] : "N/A") . "</li>";
    echo "<li><b>Visible Seam:</b> " . (!empty($_SESSION['visibleSeam'][$i]) ? $_SESSION['visibleSeam'][$i] : "N/A") . "</li>";
    echo "<li><b>Bottom Bar:</b> " . (!empty($_SESSION['bottomBar'][$i]) ? $_SESSION['bottomBar'][$i] : "N/A") . "</li>";
    echo "<li><b>Bug Brush:</b> " . (!empty($_SESSION['bugBrush'][$i]) ? $_SESSION['bugBrush'][$i] : "N/A") . "</li>";
    echo "<br>";
    echo "<li><b>Operation:</b> " . (!empty($_SESSION['operation'][$i]) ? $_SESSION['operation'][$i] : "N/A") . "</li>";
    echo "<li><b>Action Type:</b> " . (!empty($_SESSION['actionType'][$i]) ? $_SESSION['actionType'][$i] : "N/A") . "</li>";
    if (!empty($_SESSION['actionType'][$i]) && $_SESSION['actionType'][$i] === 'Motorized') {
        echo "<li><b>Motor Type:</b> " . (!empty($_SESSION['motorType'][$i]) ? $_SESSION['motorType'][$i] : "N/A") . "</li>";
        echo "<li><b>Cord Length:</b> " . (!empty($_SESSION['cordLength'][$i]) ? $_SESSION['cordLength'][$i] : "N/A") . "</li>";
        echo "<li><b>Remote Type:</b> " . (!empty($_SESSION['remoteType'][$i]) ? $_SESSION['remoteType'][$i] : "N/A") . "</li>";
    } else if (!empty($_SESSION['actionType'][$i]) && $_SESSION['actionType'][$i] === 'Manual') {
        echo "<li><b>Crank Size:</b> " . (!empty($_SESSION['crankSize'][$i]) ? $_SESSION['crankSize'][$i] : "N/A") . "</li>";
    }
    echo "<br>";

    // A2
    echo "<li><b>A2 (OAW):</b> " . (!empty($_SESSION['a2'][$i]) ? $_SESSION['a2'][$i] : "N/A") . "</li>";
    echo "<li><b>A2 Build-up Type:</b> " . (!empty($_SESSION['a2BUType'][$i]) ? $_SESSION['a2BUType'][$i] : "N/A") . "</li>";
    if (!empty($_SESSION['a2BUType'][$i] && $_SESSION['a2BUType'][$i] !== 'None')) {
        echo "<li><b>A2 Build-up Size:</b> " . (!empty($_SESSION['a2BUSize'][$i]) ? $_SESSION['a2BUSize'][$i] : "N/A") . "</li>";
    }
    echo "<li><b>A2 Attach:</b> " . (!empty($_SESSION['a2Attach'][$i]) ? $_SESSION['a2Attach'][$i] : "N/A") . "</li>";
    echo "<li><b>A2 Powder Color:</b> " . (!empty($_SESSION['a2PowderColor'][$i]) ? $_SESSION['a2PowderColor'][$i] : "N/A") . "</li>";
    echo "<br>";

    // Left B2
    echo "<li><b>Left B2 (OAH):</b> " . (!empty($_SESSION['lb2'][$i]) ? $_SESSION['lb2'][$i] : "N/A") . "</li>";
    echo "<li><b>Left B2 Build-up Type:</b> " . (!empty($_SESSION['l2BUType'][$i]) ? $_SESSION['l2BUType'][$i] : "N/A") . "</li>";
    if (!empty($_SESSION['l2BUType'][$i] && $_SESSION['l2BUType'][$i] !== 'None')) {
        echo "<li><b>Left B2 Build-up Size:</b> " . (!empty($_SESSION['l2BUSize'][$i]) ? $_SESSION['l2BUSize'][$i] : "N/A") . "</li>";
    }
    echo "<li><b>Left B2 Attach:</b> " . (!empty($_SESSION['l2Attach'][$i]) ? $_SESSION['l2Attach'][$i] : "N/A") . "</li>";
    echo "<li><b>Left B2 Mount:</b> " . (!empty($_SESSION['l2Mount'][$i]) ? $_SESSION['l2Mount'][$i] : "N/A") . "</li>";
    echo "<li><b>Left B2 Powder Color:</b> " . (!empty($_SESSION['l2PowderColor'][$i]) ? $_SESSION['l2PowderColor'][$i] : "N/A") . "</li>";
    echo "<br>";

    // Right B2
    echo "<li><b>Right B2 (OAH):</b> " . (!empty($_SESSION['rb2'][$i]) ? $_SESSION['rb2'][$i] : "N/A") . "</li>";
    echo "<li><b>Right B2 Build-up Type:</b> " . (!empty($_SESSION['r2BUType'][$i]) ? $_SESSION['r2BUType'][$i] : "N/A") . "</li>";
    if (!empty($_SESSION['r2BUType'][$i] && $_SESSION['r2BUType'][$i] !== 'None')) {
        echo "<li><b>Right B2 Build-up Size:</b> " . (!empty($_SESSION['r2BUSize'][$i]) ? $_SESSION['r2BUSize'][$i] : "N/A") . "</li>";
    }
    echo "<li><b>Right B2 Attach:</b> " . (!empty($_SESSION['r2Attach'][$i]) ? $_SESSION['r2Attach'][$i] : "N/A") . "</li>";
    echo "<li><b>Right B2 Mount:</b> " . (!empty($_SESSION['r2Mount'][$i]) ? $_SESSION['r2Mount'][$i] : "N/A") . "</li>";
    echo "<li><b>Right B2 Powder Color:</b> " . (!empty($_SESSION['r2PowderColor'][$i]) ? $_SESSION['r2PowderColor'][$i] : "N/A") . "</li>";
    echo "<br>";

    // Notes
    echo "<li><b>Notes:</b> " . (!empty($_SESSION['specialNotes'][$i]) ? $_SESSION['specialNotes'][$i] : "N/A") . "</li>";
    echo "<li><b>Screen Quote:</b> " . (!empty($_SESSION['screenPriceQuote'][$i]) ? $_SESSION['screenPriceQuote'][$i] : "N/A") . "</li>";
    echo "<li><b>Build-up Quote:</b> " . (!empty($_SESSION['screenBupQuote'][$i]) ? $_SESSION['screenBupQuote'][$i] : "N/A") . "</li>";
    echo "<li><b>Extra Cost Quote:</b> " . (!empty($_SESSION['screenExtraQuote'][$i]) ? $_SESSION['screenExtraQuote'][$i] : "N/A") . "</li>";
    echo "<li><b>Total:</b> " . (!empty($_SESSION['screenTotal'][$i]) ? $_SESSION['screenTotal'][$i] : "N/A") . "</li>";

    echo "</ul>";

    echo "<br>";

}
?>
<h3>Office Information</h3>
<ul>
    <li><b>Estimated Install Time:</b> <?= (!empty($_SESSION['installTime']) ? $_SESSION['installTime'] : "N/A"); ?></li>
    <li><b>Difficulty:</b> <?= (!empty($_SESSION['difficulty']) ? $_SESSION['difficulty'] : "N/A"); ?></li>
    <li><b>Number of Installers:</b> <?= (!empty($_SESSION['installerNumber']) ? $_SESSION['installerNumber'] : "N/A"); ?></li>
    <li><b>Equipment Required:</b> <?= (!empty($_SESSION['equipRequired']) ? $_SESSION['equipRequired'] : "N/A"); ?></li>
    <li><b>Sales Person:</b> <?= (!empty($_SESSION['salesPerson']) ? $_SESSION['salesPerson'] : "N/A"); ?></li>
</ul>