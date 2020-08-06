$(document).ready(function () {

    // var unitSection = $("#unitSection"); // section containing each unit quote
    // var screenSection = $("#screenSection"); // section containing each unit quote
    // var awningSection = $("#awningSection");

    var screenIndex = -1; // number of screens
    var awningIndex = -1; // number of awnings

    var addScreenButton = $("#addScreenButton");
    var addAwningButton = $("#addAwningButton");

    var screenTemplate = $("#screenTemplate"); // single screen template
    var awningTemplate = $("#awningTemplate"); // single awning template

    var screenArray = Array(); // array of pointers to every screen
    var awningArray = Array();

    setDependencyElements('.a2BUType', ['.a2Attach', '.a2BUSize'], ['1/2" X 1"', '3/4" X 3/4"', '1" X 1"', '2" X 2"', 'Standard L Build-up 1.5" X 2.5"',
                            'Heavy L Build-up 2" X 2"', 'Heavy L Build-up 2" X 3"', 'Custom (see notes)']);
    setDependencyElements('.l2BUType', ['.l2Attach', '.l2BUSize'], ['1/2" X 1"', '3/4" X 3/4"', '1" X 1"', '2" X 2"', 'Standard L Build-up 1.5" X 2.5"',
                            'Heavy L Build-up 2" X 2"', 'Heavy L Build-up 2" X 3"', 'Custom (see notes)']);
    setDependencyElements('.r2BUType', ['.r2Attach', '.r2BUSize'], ['1/2" X 1"', '3/4" X 3/4"', '1" X 1"', '2" X 2"', 'Standard L Build-up 1.5" X 2.5"',
                            'Heavy L Build-up 2" X 2"', 'Heavy L Build-up 2" X 3"', 'Custom (see notes)']);
    // only show custom text input on custom selection
    setDependencyElements('.awningFrameColor', ['.awningCustomColor'], ['Custom']);
    // only show wrap option on Royal, Royal Marcesa, Imperial, and Imperial Marcesa.
    setDependencyElements('.awningStyle', ['.wrapFrontProfile'], 
    ['Royal', 'Royal Marcesa', 'Royal Marcesa Cassette', 'Royal Cassette', 'Imperial', 'Imperial Marcesa']);
    setDependencyElements('.awningBrackets', ['.awningBracketType', '.awningBracketQuantity', '.awningBracketColor'], ['Yes']);
    // height only applies to diplomat 100/90, ambassador 10/40/50, and traditional
    setDependencyElements('.awningStyle', ['.awningHeightFeet', '.awningHeightInches'], ['Diplomat 100', 'Diplomat 90', 'Ambassador 10', 'Ambassador 40', 
    'Ambassador 50', 'Traditional']);

    setVisibilitySections('.actionType', '.actionTypeAuto', ['Motorized']);
    setVisibilitySections('.actionType', '.actionTypeManual', ['Manual']);
    setVisibilitySections('.motorType', '.screenRemoteSomfy', ['Somfy']);
    setVisibilitySections('.motorType', '.screenRemoteSolace', ['Solace']);
    setVisibilitySections('.awningOperation', '.awningOperationMotor', ['Motor']);
    setVisibilitySections('.awningOperation', '.awningOperationManual', ['Manual']);
    
    $(".unitSubTotal").change(function () {
        calculateUnitTotal(this);
    });

    $(".close").click(function () {
        removeUnit(this);
    })

    addScreenButton.click(function () {
        screenIndex++;
        id_text = "screen_" + screenIndex;
        var additionalScreen = screenTemplate.clone(true);
        $(additionalScreen).find('.screenTitle').text("Screen " + (screenIndex + 1));
        additionalScreen.attr("id", (id_text));
        additionalScreen.removeAttr("hidden");

        additionalScreen.insertBefore(".screenButtonRow");
        screenArray.push(additionalScreen);
        $(".screenEmpty").hide();
    });

    addAwningButton.click(function () {
        awningIndex++;
        id_text = "awning_" + screenIndex;
        var additionalAwning = awningTemplate.clone(true);
        $(additionalAwning).find('.awningTitle').text("Awning " + (awningIndex + 1));
        additionalAwning.attr("id", (id_text));
        additionalAwning.removeAttr("hidden");

        additionalAwning.insertBefore(".awningButtonRow");
        awningArray.push(additionalAwning);
        $(".awningEmpty").hide();
    });

    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {

            // $(this).find(':input').prop('required', false); // FOR DEBUGGING ONLY

            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                $(this).find(':input').prop('disabled', false);
                $(this).find('.emptySelect').val('N/A');
            }
            form.classList.add('was-validated');
          }, false);
        });
    }, false);

    function removeUnit(e) {
        $(e).parents(".unit").remove();
    }

    /**
     * Calculate and modify the unit price total for parent unit of element.
     * Total is calculated by adding sum of all elements with subTotal class in parent unit class.
     * 
     * @param {element} e the change element of the parent unit to change 
     */
    function calculateUnitTotal(e) {

        var unitTotal = 0.00;

        $(e).parents(".unit").find(".unitSubTotal").each(function(){
            unitTotal += Number($(this).val());
        });

        $(e).parents(".unit").find(".unitTotal").val(unitTotal);
    }

    /**
     * Set element dependencies by adding on change function to independentElement. If independentElement is set to any value in independentValues,
     * disable all elements in dependentElements. Enable when the value is changed to something else.
     * 
     * @param {string} independentElement 
     * @param {string} dependentElements 
     * @param {array} independentValues 
     */
    function setDependencyElements(independentElement, dependentElements, independentValues){
        // disable all dependentElements by default

        for(i = 0; i < dependentElements.length; i++){
            $(dependentElements[i]).prop('disabled', true);
        }

        // set onChange condition for independentElement
        $(independentElement).change(function(){
            var selectedText = $(this).find(':selected').text();
            // if text of independentElement is set to one of the independentValues, disable it
            if ($.inArray(selectedText, independentValues) > -1) {
                for(i = 0; i < dependentElements.length; i++){
                    $(this).parents('.unit').find(dependentElements[i]).prop('disabled', false);
                }
            } else {
                for(i = 0; i < dependentElements.length; i++){
                    $(this).parents('.unit').find(dependentElements[i]).prop('disabled', true);
                    $(this).parents('.unit').find(dependentElements[i]).val('');
                }
            }
            return;
        });
    }
    
    /**
     * Set element visibility conditions by adding on change function to independentElement. If independentElement is set to any value in independentValues,
     * show all elements in dependentElements. Hide when the value is changed to something else.
     * 
     * @param {string} independentElement 
     * @param {*} dependentSection 
     * @param {*} independentValues 
     */
    function setVisibilitySections(independentElement, dependentSection, independentValues){
        
        // hide dependentSection by default
        $(independentElement).parents('.unit').find(dependentSection).hide();
        
        $(independentElement).change(function(){
            var selectedText = $(this).find(':selected').text();
            // if text of independentElement is set to one of the independentValues, show it
            if ($.inArray(selectedText, independentValues) > -1) {
                $(this).parents('.unit').find(dependentSection).show();
                $(this).parents('.unit').find(dependentSection).find('select, input').prop('disabled', false);
            } else {
                $(this).parents('.unit').find(dependentSection).hide();
                $(this).parents('.unit').find(dependentSection).find('select, input').prop('disabled', true);
                $(this).parents('.unit').find(dependentSection).find('select, input').val('');
            }
            return;
        });
    }
});