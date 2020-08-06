<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['quoteID'])){
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>[AA] Quote Demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/theme.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="scripts/quoteForm.js"></script>
</head>

<body>
    <div class="jumbotron text-center">
        <h1>[AA] Automated Quote System</h1>
    </div>
    <div class="container">
        <form id="quoteForm" class="needs-validation" method="post" action="./formIngestion.php" novalidate>

            <h1 class="customerInfoTitle text-center w-100">Customer Information</h1>
            <div class="row align-items-end" id="customerDetailsRow">
                <div class="col-md">
                    <label>Name:</label>
                    <input type="text" class="form-control" id="customerName" name="customerName[]" required>
                </div>
                <div class="col-md">
                    <label>Address:</label>
                    <input type="text" class="form-control" id="customerAddress" name="customerAddress[]" required>
                </div>
                <div class="col-md">
                    <label>City:</label>
                    <input type="text" class="form-control" id="customerCity" name="customerCity[]" required>
                </div>
                <div class="col-md">
                    <label for="phone">Phone:</label>
                    <input type="phone" class="form-control" id="phone" name="customerPhone[]" required>
                </div>
                <div class="col-md">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="customerEmail[]" required>
                </div>
            </div>
            <hr/>
            <div id="unitSection">
                <div id="awningSection">
                    <div class="row">
                        <h1 class="text-center w-100">Awnings</h1>
                    </div>
                    <div class="row awningEmpty">
                        <div class="col-md">
                            click to add an awning
                        </div>
                    </div>
                    <div class="row awningButtonRow">
                        <div class="col-md">
                            <button type="button" class="btn btn-primary m-2 active float-right" id="addAwningButton">Add Awning</button>
                        </div>
                    </div>
                </div>
                <hr/>
                <div id="screenSection">
                    <div class="row">
                        <h1 class="text-center w-100">Screens</h1>
                    </div>
                    <div class="row screenEmpty">
                        <div class="col-md">
                            click to add a screen
                        </div>
                    </div>
                    <div class="row screenButtonRow">
                        <div class="col-md">
                            <button type="button" class="btn btn-primary m-2 active float-right" id="addScreenButton">Add Screen</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row mb-3">
                <h1 class="officeInformation text-center w-100">Office Information</h1>
            </div>
            <div class="row mb-3 align-items-end" id="officeInfo">
                <div class="col-md">
                    <label>Estimated Install Time:</label>
                    <input type="text" class="form-control installTime" name="installTime" required>
                </div>
                <div class="col-md">
                    <label>Install Difficulty<br />(10 = hard):</label>
                    <input type="number" class="form-control difficulty" name="difficulty" min="1" max="10" required>
                </div>
                <div class="col-md">
                    <label># of installers:</label>
                    <input type="number" class="form-control installerNumber" name="installerNumber" min="0" required>
                </div>
                <div class="col-md">
                    <label>Equipment Required:</label>
                    <input type="text" class="form-control equipRequired" name="equipRequired" required>
                </div>
            </div>
            <div class="row mb-3 align-items-end">
            <div class="col-md-6"></div>
            <div class="col-md">
                <label>Sales Person:</label>
                <input type="text" class="form-control salesPerson" name="salesPerson" required>
            </div>
            <div class="col-md">
                <label>Password:</label>
                <input type="password" class="form-control superSecretPass" name="superSecretPass" required>
            </div>
        </div>
            <div class="row mb-3" id="buttonRow">
                <div class="col">
                    <button type="submit" class="btn btn-success m-2 float-right" name="newForm" value="true">Submit</button>
                </div>
            </div>
    </div>
    </form>
    <div id="awningTemplate" class="list-group-item rounded unit" hidden>
        <div class="row mb-3">
            <div class="col">
                <h3 class="awningTitle d-inline">Awning Template</h3>
                <button type="button" class="close float-right mb-3" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="row mb-3 align-items-end">
            <div class="col-md-10">
                <label>Awning Style:</label>
                <select class="form-control awningStyle" name="awningStyle[]" required>
                    <option selected hidden value=""></option>
                    <option>Royal Marcesa</option>
                    <option>Royal</option>
                    <option>Royal Marcesa Cassette</option>
                    <option>Royal Cassette</option>
                    <option>Imperial Marcesa</option>
                    <option>Imperial</option>
                    <option>Imperial Adjustable Valance</option>
                    <option>Imperial Crossover</option>
                    <option>Marcesa</option>
                    <option>Classic</option>
                    <option>Empress Marcesa</option>
                    <option>Empress</option>
                    <option>Grand Vienna</option>
                    <option>Grand Vienna Drop</option>
                    <option>Baron</option>
                    <option>Baroness</option>
                    <option>Diplomat 100</option>
                    <option>Diplomat 90</option>
                    <option>Duchess</option>
                    <option>Ambassador 50</option>
                    <option>Ambassador 10</option>
                    <option>Ambassador 40</option>
                    <option>Traditional</option>
                </select>
            </div>
            <div class="col-md-2 royalImperialMarcesa">
                <label>Wrap Front Profile:</label>
                <select class="form-control wrapFrontProfile" name="wrapFrontProfile[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Yes</option>
                    <option>No</option>
                </select>
            </div>
        </div>
        <div class="row mb-3 align-items-end">
            <div class="col-md">
                <label>Width:</label>
                <div class="input-group">
                    <input type="number" min="0" step="1" class="form-control awningWidthFeet" name="awningWidthFeet[]" required>
                    <div class="input-group-append d-none d-md-block">
                        <span class="input-group-text">ft.</span>
                    </div>
                    <input type="number" min="0" max="12" step=".1" class="form-control awningWidthInches" name="awningWidthInches[]" required>
                    <div class="input-group-append d-none d-md-block">
                        <span class="input-group-text">in.</span>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <label>Projection:</label>
                <div class="input-group">
                    <input type="number" min="0" step="1" class="form-control awningProjectionFeet" name="awningProjectionFeet[]" required>
                    <div class="input-group-append d-none d-md-block">
                        <span class="input-group-text">ft.</span>
                    </div>
                    <input type="number" min="0" max="12" step=".1" class="form-control awningProjectionInches" name="awningProjectionInches[]" required>
                    <div class="input-group-append d-none d-md-block">
                        <span class="input-group-text">in.</span>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <label>Height:</label>
                <div class="input-group">
                    <input type="number" min="0" step="1" class="form-control awningHeightFeet" name="awningHeightFeet[]" required>
                    <div class="input-group-append d-none d-md-block">
                        <span class="input-group-text">ft.</span>
                    </div>
                    <input type="number" min="0" max="12" step=".1" class="form-control awningHeightInches" name="awningHeightInches[]" required>
                    <div class="input-group-append d-none d-md-block">
                        <span class="input-group-text">in.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 align-items-end">
            <div class="col-md">
                <label>Frame Color:</label>
                <select class="form-control awningFrameColor" name="awningFrameColor[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>White</option>
                    <option class="royalImperialMarcesa">Black</option>
                    <option class="royalImperialMarcesa">Clay</option>
                    <option>Custom</option>
                </select>
            </div>
            <div class="col-md">
                <label>Custom Color:</label>
                <input type="text" class="form-control awningCustomColor" name="awningCustomColor[]" placeholder="N/A" required>
            </div>
        </div>
        <div class="row mb-3 align-items-end">
            <div class="col-md-3">
                <label>Operation:</label>
                <select class="form-control awningOperation" name="awningOperation[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Motor</option>
                    <option>Manual</option>
                    <option>Fixed</option>
                    <option>None</option>
                </select>
            </div>
            <div class="col-md awningOperationMotor">
                <label>Motor Type:</label>
                <select class="form-control awningMotorType" name="awningMotorType[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>RTS</option>
                    <option>CMO (Sunea)</option>
                    <option>Standard (Hardwire)</option>
                    <option>Orea</option>
                </select>
            </div>
            <div class="col-md awningOperationMotor">
                <label>Cord Length:</label>
                <select class="form-control awningCordLength" name="awningCordLength[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>3'</option>
                    <option>6'</option>
                    <option>12'</option>
                    <option>18'</option>
                    <option>24'</option>
                </select>
            </div>
            <div class="col-md awningOperationMotor">
                <label>Remote:</label>
                <select class="form-control awningRemote" name="awningRemote[]" required>
                    <option class="emptySelect" selected hidden></option>
                    <option>T1</option>
                    <option>T4</option>
                    <option>T1 Wall Switch</option>
                    <option>T4 Wall Switch</option>
                    <option>16 Channel</option>
                </select>
            </div>
            <div class="col-md awningOperationMotor">
                <label>Wind Sensor:</label>
                <select class="form-control awningWindSensor" name="awningWindSensor[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Yes</option>
                    <option>No</option>
                </select>
            </div>
            <div class="col-md awningOperationManual">
                <label>Crank Size:</label>
                <select class="form-control awningCrankSize" name="awningCrankSize[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>40"</option>
                    <option>56"</option>
                    <option>64"</option>
                    <option>80"</option>
                    <option>96"</option>
                </select>
            </div>
        </div>
        <div class="row mb-3 align-items-end">
            <div class="col-md">
                <label>Control:</label>
                <select class="form-control awningControl" name="awningControl[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Right</option>
                    <option>Left</option>
                </select>
            </div>
            <div class="col-md">
                <label>Control Notes:</label>
                <input type="text" class="form-control awningControlNotes" name="awningControlNotes[]">
            </div>
            <div class="col-md">
                <label>Hood Cover:</label>
                <select class="form-control awningHoodCover" name="awningHoodCover[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>None</option>
                    <option>White</option>
                    <option>Black</option>
                    <option>Anodized</option>
                </select>
            </div>
            <div class="col-md">
                <label>Fabric:</label>
                <input type="text" class="form-control awningFabric" name="awningFabric[]" required>
            </div>
            <div class="col-md">
                <label>Valance:</label>
                <select class="form-control awningValance" name="awningValance[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Straight</option>
                    <option>Standard Wave</option>
                    <option>Shallow Wave</option>
                    <option>Square Cut</option>
                    <option>None</option>
                </select>
            </div>
            <div class="col-md">
                <label>Trim:</label>
                <input type="text" class="form-control awningTrim" name="awningTrim[]" required>
            </div>
        </div>
        <div class="row mb-3 align-items-end">
            <div class="col-md-3">
                <label>Mount:</label>
                <select class="form-control awningMount" name="awningMount[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Beam</option>
                    <option>Post</option>
                    <option>Face of Wall</option>
                    <option>Roof</option>
                    <option>Soffit</option>
                </select>
            </div>
            <div class="col-md-9">
                <label>Mount Notes:</label>
                <input type="text" class="form-control awningMountNotes" name="awningMountNotes[]">
            </div>
        </div>
        <div class="row mb-3 align-items-end">
            <div class="col-md-3">
                <label>Brackets:</label>
                <select class="form-control awningBrackets" name="awningBrackets[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Yes</option>
                    <option>No</option>
                </select>
            </div>
            <div class="col-md awningBracketsTrue">
                <label>Bracket Type:</label>
                <select class="form-control awningBracketType" name="awningBracketType[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Roof Mount Brackets</option>
                    <option>Hood Lid Brackets</option>
                    <option>Soffit Brackets</option>
                </select>
            </div>
            <div class="col-md awningBracketsTrue">
                <label>Bracket Quantity:</label>
                <input type="number" min="0" class="form-control awningBracketQuantity" name="awningBracketQuantity[]" required>
            </div>
            <div class="col-md awningBracketsTrue">
                <label>Bracket Color:</label>
                <input type="text" class="form-control awningBracketColor" name="awningBracketColor[]" required>
            </div>
        </div>
        <div class="row mb-3 align-items-end">
            <div class="col-md-2">
                <label>Placement on House:</label>
                <select class="form-control awningHousePlacement" name="awningHousePlacement[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Front</option>
                    <option>Back</option>
                    <option>Right Side</option>
                    <option>Left Side</option>
                </select>
            </div>
            <div class="col-md-10">
                <label for="awningSpecialNotes">Special Notes</label>
                <textarea class="form-control awningSpecialNotes" form="quoteForm" rows="2" name="awningSpecialNotes[]"></textarea>
            </div>
        </div>
        <div class="row mb-3 align-items-end awningQuoteRow">
            <div class="col-md">
                <label>Awning Quote:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="number" min="0" step=".01" class="form-control unitSubTotal awningPriceQuote" name="awningPriceQuote[]">
                </div>
            </div>
            <div class="col-md">
                <label>Motor Quote:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="number" min="0" step=".01" class="form-control unitSubTotal awningMotorQuote" name="awningMotorQuote[]">
                </div>
            </div>
            <div class="col-md">
                <label>Bracket Quote:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="number" min="0" step=".01" class="form-control unitSubTotal awningBracketQuote" name="awningBracketQuote[]">
                </div>
            </div>
            <div class="col-md">
                <label>Extra Cost Quote:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="number" min="0" step=".01" class="form-control unitSubTotal awningExtraQuote" name="awningExtraQuote[]">
                </div>
            </div>
        </div>
        <div class="row mb-3 align-items-end">
            <div class="col-md-7"></div>
            <div class="col-md-5">
                <label>Total:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="number" min="0" step=".01" class="form-control unitTotal awningTotal" name="awningTotal[]" readonly>
                </div>
            </div>
        </div>
    </div>
    <div id="screenTemplate" class="list-group-item rounded unit" hidden>
        <div class="row mb-3 align-items-end">
            <div class="col-md">
                <h3 class="screenTitle d-inline">Screen Template</h3>
                <button type="button" class="close float-right mb-3" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="row mb-3 align-items-end">
            <div class="col-md">
                <label>Box Face:</label>
                <select class="form-control boxFace" name="boxFace[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>In</option>
                    <option>Out</option>
                </select>
            </div>
            <div class="col-md">
                <label>Fabric Density:</label>
                <input type="text" class="form-control fabricDensity" name="fabricDensity[]" required>
            </div>
            <div class="col-md">
                <label>Fabric Color:</label>
                <input type="text" class="form-control fabricColor" name="fabricColor[]" required>
            </div>
            <div class="col-md">
                <label>Dark Side Face:</label>
                <select class="form-control darkSideFace" name="darkSideFace[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Back of Box</option>
                    <option>Front of Box</option>
                    <option>None</option>
                </select>
            </div>
            <div class="col-md">
                <label>Visible Seam:</label>
                <select class="form-control visibleSeam" name="visibleSeam[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Top</option>
                    <option>Bottom</option>
                    <option>None</option>
                </select>
            </div>
            <div class="col-md">
                <label>Bottom Bar:</label>
                <select class="form-control bottomBar" name="bottomBar[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Regular</option>
                    <option>Adjusted</option>
                </select>
            </div>
            <div class="col-md">
                <label>Bug Brush:</label>
                <select class="form-control bugBrush" name="bugBrush[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>None</option>
                    <option>1/4"</option>
                    <option>1"</option>
                    <option>Special</option>
                </select>
            </div>
        </div>
        <div class="row mb-3 align-items-end">
            <div class="col-md-2">
                <label>Operation:</label>
                <select class="form-control" name="operation[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Right</option>
                    <option>Left</option>
                </select>
            </div>
            <div class="col-md-2">
                <label>Action Type:</label>
                <select class="form-control actionType" name="actionType[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Motorized</option>
                    <option>Manual</option>
                </select>
            </div>
            <div class="col-md actionTypeAuto">
                <label>Motor:</label>
                <select class="form-control motorType" name="motorType[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Solace</option>
                    <option>Somfy</option>
                </select>
            </div>
            <div class="col-md actionTypeAuto">
                <label>Cord:</label>
                <div class="input-group">
                    <input type="number" min="0" step=".1" class="form-control cordLength" name="cordLength[]" required>
                    <div class="input-group-append d-none d-md-block">
                        <span class="input-group-text">ft.</span>
                    </div>
                </div>
            </div>
            <div class="col-md actionTypeAuto">
                <label>Remote:</label>
                <select class="form-control remoteType" name="remoteType[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option class="screenRemoteSolace">1 Channel</option>
                    <option class="screenRemoteSolace">15 Channel</option>
                    <option class="screenRemoteSolace">1 Channel Wall Switch</option>
                    <option class="screenRemoteSolace">15 Channel Wall Switch</option>
                    <option class="screenRemoteSomfy">T1</option>
                    <option class="screenRemoteSomfy">T4</option>
                    <option class="screenRemoteSomfy">T1 Wall Switch</option>
                    <option class="screenRemoteSomfy">T4 Wall Switch</option>
                    <option class="screenRemoteSomfy">16 Channel</option>
                </select>
            </div>
            <div class="col-md actionTypeManual">
                <label>Crank Size:</label>
                <input type="text" class="form-control crankSize" name="crankSize[]" required>
            </div>
        </div>
        <div class="row mb-3 align-items-end">
            <div class="col-md">
                <label>A2 (OAW):</label>
                <div class="input-group">
                    <input type="number" min="0" step=".1" class="form-control a2" name="a2[]" required>
                    <div class="input-group-append d-none d-md-block">
                        <span class="input-group-text">in.</span>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <label>B/U Type</label>
                <select class="form-control a2BUType" name="a2BUType[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>None</option>
                    <option>1/2" X 1"</option>
                    <option>3/4" X 3/4"</option>
                    <option>1" X 1"</option>
                    <option>2" X 2"</option>
                    <option>Standard L Build-up 1.5" X 2.5"</option>
                    <option>Heavy L Build-up 2" X 2"</option>
                    <option>Heavy L Build-up 2" X 3"</option>
                    <option>Custom (see notes)</option>
                </select>
            </div>
            <div class="col-md">
                <label>B/U Size:</label>
                <div class="input-group">
                    <input type="number" min="0" step=".1" class="form-control a2BUSize" placeholder="N/A" name="a2BUSize[]" required>
                    <div class="input-group-append d-none d-md-block">
                        <span class="input-group-text">in.</span>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <label>Attach:</label>
                <select class="form-control a2Attach" name="a2Attach[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Yes</option>
                    <option>No</option>
                </select>
            </div>
            <div class="col-md">
                <label>Powder Color:</label>
                <input type="text" class="form-control a2PowderColor" name="a2PowderColor[]" required>
            </div>
        </div>
        <div class="row mb-3 align-items-end">
            <div class="col-md">
                <label>Left B2 (OAH):</label>
                <div class="input-group">
                    <input type="number" min="0" step=".1" class="form-control lb2" name="lb2[]" required>
                    <div class="input-group-append d-none d-md-block">
                        <span class="input-group-text">in.</span>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <label>B/U Type</label>
                <select class="form-control l2BUType" name="l2BUType[]" required>
                    <option class="emptySelect" selected hidden></option>
                    <option>None</option>
                    <option>1/2" X 1"</option>
                    <option>3/4" X 3/4"</option>
                    <option>1" X 1"</option>
                    <option>2" X 2"</option>
                    <option>Standard L Build-up 1.5" X 2.5"</option>
                    <option>Heavy L Build-up 2" X 2"</option>
                    <option>Heavy L Build-up 2" X 3"</option>
                    <option>Custom (see notes)</option>
                </select>
            </div>
            <div class="col-md">
                <label>B/U Size:</label>
                <div class="input-group">
                    <input type="number" min="0" step=".1" class="form-control l2BUSize" placeholder="N/A" name="l2BUSize[]" required>
                    <div class="input-group-append d-none d-md-block">
                        <span class="input-group-text">in.</span>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <label>Attach:</label>
                <select class="form-control l2Attach" name="l2Attach[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Yes</option>
                    <option>No</option>
                </select>
            </div>
            <div class="col-md">
                <label>Mount:</label>
                <select class="form-control l2Mount" name="l2Mount[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Surface Mount (drill through side)</option>
                    <option>Recessed Back (drill through back)</option>
                    <option>Recessed Rails</option>
                    <option>No Holes</option>
                </select>
            </div>
            <div class="col-md">
                <label>Powder Color:</label>
                <input type="text" class="form-control l2PowderColor" name="l2PowderColor[]" required>
            </div>
        </div>
        <div class="row mb-3 align-items-end">
            <div class="col-md">
                <label>Right B2 (OAH):</label>
                <div class="input-group">
                    <input type="number" min="0" step=".1" class="form-control rb2" name="rb2[]" required>
                    <div class="input-group-append d-none d-md-block">
                        <span class="input-group-text">in.</span>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <label>B/U Type</label>
                <select class="form-control r2BUType" name="r2BUType[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>None</option>
                    <option>1/2" X 1"</option>
                    <option>3/4" X 3/4"</option>
                    <option>1" X 1"</option>
                    <option>2" X 2"</option>
                    <option>Standard L Build-up 1.5" X 2.5"</option>
                    <option>Heavy L Build-up 2" X 2"</option>
                    <option>Heavy L Build-up 2" X 3"</option>
                    <option>Custom (see notes)</option>
                </select>
            </div>
            <div class="col-md">
                <label>B/U Size:</label>
                <div class="input-group">
                    <input type="number" min="0" step=".1" class="form-control r2BUSize" placeholder="N/A" name="r2BUSize[]" required>
                    <div class="input-group-append d-none d-md-block">
                        <span class="input-group-text">in.</span>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <label>Attach:</label>
                <select class="form-control r2Attach" name="r2Attach[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Yes</option>
                    <option>No</option>
                </select>
            </div>
            <div class="col-md">
                <label>Mount:</label>
                <select class="form-control r2Mount" name="r2Mount[]" required>
                    <option selected hidden class="emptySelect"></option>
                    <option>Surface Mount (drill through side)</option>
                    <option>Recessed Back (drill through back)</option>
                    <option>Recessed Rails</option>
                    <option>No Holes</option>
                </select>
            </div>
            <div class="col-md">
                <label>Powder Color:</label>
                <input type="text" class="form-control r2PowderColor" name="r2PowderColor[]" required>
            </div>
        </div>
        <div class="row mb-3 align-items-end" id="notesRow">
            <div class="col-md">
                <label for="specialNotes">Special Notes</label>
                <textarea class="form-control specialNotes" form="quoteForm" rows="2" name="specialNotes[]"></textarea>
            </div>
        </div>
        <div class="row mb-3 align-items-end screenQuoteRow">
            <div class="col-md">
                <label>Screen Quote:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="number" min="0" step=".01" class="form-control unitSubTotal screenPriceQuote" name="screenPriceQuote[]">
                </div>
            </div>
            <div class="col-md">
                <label>Build-up Quote:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="number" min="0" step=".01" class="form-control unitSubTotal screenBupQuote" name="screenBupQuote[]">
                </div>
            </div>
            <div class="col-md">
                <label>Extra Cost Quote:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="number" min="0" step=".01" class="form-control unitSubTotal screenExtraQuote" name="screenExtraQuote[]">
                </div>
            </div>
        </div>
        <div class="row mb-3 align-items-end">
            <div class="col-md-7"></div>
            <div class="col-md-5">
                <label>Total:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="number" min="0" step=".01" class="form-control unitTotal screenTotal" name="screenTotal[]" readonly>
                </div>
            </div>
        </div>
    </div>

</html>