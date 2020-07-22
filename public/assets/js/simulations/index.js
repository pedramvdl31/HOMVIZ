window.populationType = []
window.states = []
window.resources = []

window.tableFlagstate = 0
window.currentstep = 0
window.popovers = {}
window.totalPopulation = {}

//validation
window.loc = 0
window.stateset = 0
window.params = 0

//debug
window.debug = 0

$('.general-info').tooltip();

$(document).ready(function(){

  const general_Toast = Swal.mixin({
    toast: true,
    position: 'center',
    showConfirmButton: true,
    animation:true
  });

  window.info_Toast = Swal.mixin({
    toast: true,
    position: 'center',
    showConfirmButton: true,
    animation:true
  });

  window.Toast = Swal.mixin({
    toast: true,
    position: 'center',
    showConfirmButton: true,
    animation:true
  });

  $("#mcontent").css("display","block")

  $('#smartwizard').smartWizard({
    selected: 0,
    theme: 'arrows',
    showStepURLhash: false,
    transitionEffect:'fade',
    toolbarSettings: {
      showNextButton: false, // show/hide a Next button
      showPreviousButton: false // show/hide a Previous button
    }, 
    anchorSettings: {
      anchorClickable: false, // Enable/Disable anchor navigation
      enableAllAnchors: false, // Activates all anchors clickable all times
      markDoneStep: true, // add done css
      enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
    },
    transitionEffect: 'fade', // Effect on navigation, none/slide/fade
    transitionSpeed: '100',
    keyNavigation: false
  });

  $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {

    window.currentstep = stepNumber + 1

    $('#next').text('Next Step')

    if (window.currentstep==1) {

      $('#prev').attr('disabled','true')
      
      step1HandleErrors()

    } else if (window.currentstep==2) {

      $('#prev').removeAttr('disabled')

      step2HandleErrors()

    } else if (window.currentstep==3) {

      $('#prev').removeAttr('disabled')

      step3HandleErrors()

    } else if (window.currentstep==4) {

      $('#prev').removeAttr('disabled')

      step4HandleErrors()

    } else if (window.currentstep==5) {

      $('#prev').removeAttr('disabled')
      $('#next').text('Run Simulation')

      step5HandleErrors()

    }

  });

  //WIZARD STEP RULES
  if (!window.debug) {

    $('#smartwizard').smartWizard('reset');

    $('#next').on('click', function(e){

      HandleStepsOnNextBtnClick()

    })

    $('#prev').on('click', function(e){

      $('#smartwizard').smartWizard("prev")
      
    })

  } else {

    window.populationType = ['Male', 'Female', 'Other']

    $('#next').on('click', function(e){

      HandleStepsOnNextBtnClick()
        
    })

    $('#prev').on('click', function(e){

      $('#smartwizard').smartWizard("prev")
      
    })

  }

  setTimeout(function(){

    window.scroll({
    top: 0, 
    left: 0, 
    behavior: 'auto'
    });

  }, 1500)


  $(document).on("keypress",".no-special-chars",function() {

      var regex = new RegExp("^[ a-zA-Z0-9]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
      if (!regex.test(key)) {
         event.preventDefault();
         return false;
      }

  });

  // STEP 1

  $('#simulation-name').on('keyup blur', function(e) {
    step1HandleErrors()
  })

  $(document).on("keypress",".pop-input-validation, .maxlength-input-validation, .capacity-input-validation",function(event) {

      var regex = new RegExp("^[0-9]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

      if (!regex.test(key)) {
         event.preventDefault();
         return false;
      }

      if ($(this).val()<1 && String.fromCharCode(event.keyCode)<1) {
        $(this).val(1)
         event.preventDefault();
         return false;
      }

      if ($(this).val()+String.fromCharCode(event.keyCode)>100000) {
        $(this).val(100000)
         event.preventDefault();
         return false;
      }

  });

  $(document).on("blur",".pop-input-validation,maxlength-input-validation, .capacity-input-validation",function(event) {

      if ($(this).val()=='') {
        $(this).val(1)
      }

  });

  $(document).on("keypress",".initpop-input-validation",function(event) {

      var regex = new RegExp("^[0-9]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

      if (!regex.test(key)) {
         event.preventDefault();
         return false;
      }

      if ($(this).val()<=0 && String.fromCharCode(event.keyCode)<1) {
        $(this).val(0)
         event.preventDefault();
         return false;
      }

      if ($(this).val()+String.fromCharCode(event.keyCode)>100000) {
        $(this).val(100000)
         event.preventDefault();
         return false;
      }


      if ($(this).val()==0) {
        $(this).val(String.fromCharCode(event.keyCode))
         event.preventDefault();
         return false;
      }

  });

  $(document).on("blur",".initpop-input-validation",function(event) {

      if ($(this).val()=='') {
        $(this).val(0)
      }

  });

  $(document).on("keypress","#simweeks",function(event) {

      var regex = new RegExp("^[0-9]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

      if (!regex.test(key)) {
         event.preventDefault();
         return false;
      }

      if ($(this).val()<=0 && String.fromCharCode(event.keyCode)<1) {
        $(this).val(1)
         event.preventDefault();
         return false;
      }

      if ($(this).val()+String.fromCharCode(event.keyCode)>520) {
        $(this).val(520)
         event.preventDefault();
         return false;
      }

      if ($(this).val()==0) {
        $(this).val(String.fromCharCode(event.keyCode))
         event.preventDefault();
         return false;
      }

  });

  $(document).on("keypress","#simnum",function(event) {

      var regex = new RegExp("^[0-9]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

      if (!regex.test(key)) {
         event.preventDefault();
         return false;
      }

      if ($(this).val()<=0 && String.fromCharCode(event.keyCode)<1) {
        $(this).val(1)
         event.preventDefault();
         return false;
      }

      if ($(this).val()+String.fromCharCode(event.keyCode) > 10) {
        $(this).val(10)
         event.preventDefault();
         return false;
      }

      if ($(this).val()==0) {
        $(this).val(String.fromCharCode(event.keyCode))
         event.preventDefault();
         return false;
      }

  });

  $('#cname, #simweeks, #simnum').on('keyup blur', function(e) {
    step5HandleErrors()
  })

  //*********************************
  //**************************STEP 2

  var number = document.getElementsByClassName('pop-total-nums');

  // Listen for input event on numInput.
  number.onkeydown = function(e) {
      if(!((e.keyCode > 95 && e.keyCode < 106)
        || (e.keyCode > 47 && e.keyCode < 58) 
        || e.keyCode == 8)) {
          return false;
      }
  }

  $('#populationbtn').on('click', function(e) {


    if ($(this).hasClass('btn-primary')) {

      $('#pop-spchrter-error').css('display','none')

      if ($("#populationtext").val().length != 0){

        let input_val = $("#populationtext").val()

        var format = /[`_!@#$%^&*()+\-=\[\]{};':"\\|.<>\/?~]/;

        if ( !format.test(input_val) ) {

          $(this).text('Reset table')
          $(this).removeClass('btn-primary').addClass('btn-danger')
          $('#populationtext').attr('disabled','true')
          $('#populationtext').val('')


          input_val = input_val.replace(/\s/g , "");

          let popTableTbody = $('#_table #populationtable tbody')
          popTableTbody.html("")


          window.populationType = []
          let tableRow = ''

          let input_separated = input_val.split(',')

          $.each( input_separated, function( k1, value ) {

            value = escape(value.trim())

            window.populationType.push(value)

            tableRow +=   '<tr>'+
                        '<td style="font-weight: 900">'+value+'</td>'+
                        '<td class="ttd"><input type="number" id="population-'+value+'" min="1" max="100000" step="1" class="form-control pop-total-nums pop-input-validation" name="populationTypeCount['+value+']" style="width:100px; height:100%;" value="1">'+
                        '</td></tr>';

          });

          popTableTbody.append(tableRow)

          $('#pop-count-info').css('display','inline-block')

        } else {

          $('#pop-spchrter-error').css('display','block')

        }

      }

    } else {

      let popTableTbody = $('#_table #populationtable tbody')
      popTableTbody.html("<tr><td></td><td></td></tr>")

      window.populationType = []

      $('#populationbtn').removeAttr('disabled')
      $('#pop-count-info').css('display','none')

      $(this).text('Generate table')
      $(this).removeClass('btn-danger').addClass('btn-primary')
      $('#populationtext').removeAttr('disabled')

    }

    step2HandleErrors()

  });





  //********************************
  //***********************STEP 2 END



  //*********************************
  //**************************STEP 3


  $('#resourcebtn').on('click', function(e) {

    var elem = document.getElementById("resselect");
    var id = elem.options[elem.selectedIndex].id;

    let name = elem.options[elem.selectedIndex].value;
    let nameForShow = '';

    if (id=='Rehabilitation') {

      nameForShow = 'Addiction / Rehabilitation Center'
      name = 'Rehabilitation'

    } else {

      nameForShow = name

    }

    if (id != 'title'){

      let type = $('option[id='+id+']').attr('type')

      //is this the first row
      let rowCount = $("#restable tbody .mainrow").length
      if (rowCount== 0) {
        $("#restable tbody tr").remove()
      }

      let rowID = makeid(5)
      var myEle = document.getElementById(rowID);
      while(myEle){
        rowID = makeid(5)
        myEle = document.getElementById(rowID);
      }

      var obj = {};
      obj[rowID] = name;

      window.resources.push(obj)

      let tooltipClass = "tooltip-"+rowID
      let row = MakeResourcesRowColumnHTML(rowID,tooltipClass,type,name,nameForShow)

      $("#restable tbody").append(row)

      $('.'+tooltipClass).tooltip();

      activatePopUpWindows(rowID,type)

    }

    step3HandleErrors()

  })

  
  $(document).on("click",".dismisspopover",function(e,data) {
    $('.popover-all').popover('hide');
  })

  $(document).on("click",".closepop",function(e,data) {

    let id = $(this).attr('id')
    let mainId =  id.substr(5);

    console.log(id)

    if (id.substring(0, 4)=='cpop') {

      console.log('here1')

      let currentCap = parseInt($(this).parents('.popover-content').first().find('.capacity-inputs').val())

      if (currentCap!=-1) {

        if(typeof window.totalPopulation[mainId] !== 'undefined') {

            if (window.totalPopulation[mainId]>currentCap) {
              
              general_Toast.fire({
                title: 'Error',
                text: "Capacity cannot be less than the initial population counts.",
                icon: 'error'
              })

              return false

            }

        } else {

          general_Toast.fire({
            title: 'Error',
            text: "Initial population counts must be set first.",
            icon: 'error'
            })

          return false

        }

      }

    } else if(id.substring(0, 4)=='ipop') {

        let allInputs = $(this).parents('.popover-content').first().find('.initpop-input')

        let total = 0

        $('.initpop-input-'+mainId).each(function (i) {
            total += parseInt($(this).val())
        });

        console.log('h2')
        console.log(total)

        window.totalPopulation[mainId] = total

    }

    let html = $(this).parents('.popover-content').first().find('div').first().clone();

    if(typeof window.popovers[id] !== 'undefined') {
      window.popovers[id] = html
    }

    let type = $(this).attr('type')

    // Allowed pop is changed, change init pop table
    if (type == 'ap') {

      let rowCheckboxes = $(this).parents('.popover-content').first().find('table').find('input[type=checkbox]')

      let populationArray = []

      rowCheckboxes.each(function () {
         if (this.checked) {
            populationArray.push($(this).attr('value'))
         }
      });

      let rootID = id.replace('apop-', '')
      let _type = rowCheckboxes.attr('kind')

      updateIpopHTML(populationArray,rootID,_type)

    }

    let notset_elem = $(document).find('li a[id="'+id+'"]').parents('li').first().find('.not-set')

    notset_elem.attr('title','check').attr('data-original-title','check')
    notset_elem.find('i').removeClass('fa-times-circle').removeClass('text-danger').addClass('fa-check-circle').addClass('text-success')
    notset_elem.removeClass('not-set').addClass('set')

    $('.popover-all').popover('hide');

  });


  $(document).on("change",".capacities-infinite",function(e,data) {

    let _this_id = $(this).attr('thisid')

    if(this.checked) {
      $(this).parents('td').first().find('.capacity-inputs').first().val('-1').attr('disabled','true');
      let _inpt = '<input id="inf-cap-'+_this_id+'" type="hidden" name="capacity[resource]['+_this_id+']" value="-1">'
      $(this).parents('td').first().append(_inpt)
    } else {
      $(this).parents('td').first().find('.capacity-inputs').first().val('1').removeAttr('disabled');
      $('#inf-cap-'+_this_id).remove()
    }
  });

  $(document).on("click",".divideRes",function(e,data) {

    let elem = $(this).parents('tr').first()

    let parentName = elem.attr('name')

    //Remove Propreties Column
    elem.find('td').eq(3).html('')

    let rowcount = elem.attr('count')

    let type = elem.attr('type');

    let parentID = elem.attr('id')

    removeAllPopoverOfID(parentID)

    let subRowCount = $(document).find('tr[parentID='+parentID+']').length

    let rowID = makeid(5)
    var myEle = document.getElementById(rowID);
    while(myEle){
      rowID = makeid(5)
      myEle = document.getElementById(rowID);
    }

    let tooltipClass= "tooltip-"+rowID

    let row = MakeSUBResourcesRowColumnHTML(rowID,parentID,subRowCount,tooltipClass,parentName)

    if (subRowCount==0) {

      elem.addClass('parentrow')

      $(row).insertAfter(elem);

    } else {

      let childElem = $(document).find('tr[parentID='+parentID+']').last()

      childElem.addClass('nthsub')

      $(row).insertAfter(childElem);

    }

    $('.'+tooltipClass).tooltip();

    activatePopUpWindows(rowID,type)

  })

  $(document).on('click','.removeResRow', function(){

    let elem = $(this).parents('tr').first();
    let rowID = elem.attr('id')

    window.resources.splice( window.resources.indexOf(rowID), 1 );

    removeAllPopoverOfID(rowID)
    
    //ALL SUB-ROWS
    $(document).find('tr[parentID='+rowID+']').each(function( index ) {

      let rowid = $(this).attr('id')

      removeAllPopoverOfID(rowid)
      
      $(this).remove()

    });

    elem.remove()

    //if no more row left
    let rowCount = $("#restable tbody .mainrow").length

    if (rowCount==0) {

      $("#restable tbody").append('<tr><td></td><td></td><td></td><td></td><td></td></tr>')
      
    }

    step3HandleErrors()

  })

  $(document).on('click','.removeResSubRow', function(){

    let elem = $(this).parents('tr').first();
    let rowID = elem.attr('id')
    let parentID = elem.attr('parentID')

    removeAllPopoverOfID(rowID)

    elem.remove()

    //IF THIS IS THE LAST SUBROW THEN ADD PROP TD TO THE MAINROW
    let subRowCount = $(document).find('tr[parentID='+parentID+']').length

    if (subRowCount == 0) {
      let parentElem = $(document).find('tr[id='+parentID+']')
      let type = parentElem.attr('type')
      let td3 = makeResourcesPropretiesTD(parentID)
      parentElem.removeClass('parentrow')
      parentElem.find('td').eq(2).html(td3)
      activatePopUpWindows(parentID,type)
    }

  })


  //********************************
  //***********************STEP 3 END


  //*********************************
  //**************************STEP 4

  $('#statebtn').on('click', function(e) {

    var elem = document.getElementById("stateselect");
    var id = elem.options[elem.selectedIndex].id;
    let name = elem.options[elem.selectedIndex].value;

    if (id != 'title'){

      let type = $('option[id='+id+']').attr('type')

      //is this the first row
      let rowCount = $("#statetable tbody .mainrow").length
      if (rowCount== 0) {
        $("#statetable tbody tr").remove()
      }

      let rowID = makeid(5)
      var myEle = document.getElementById(rowID);
      while(myEle){
        rowID = makeid(5)
        myEle = document.getElementById(rowID);
      }

      var obj = {};
      obj[rowID] = name;
      window.states.push(obj)

      let tooltipClass = "tooltip-"+rowID
      let row = MakeStatesRowColumnHTML(rowID,tooltipClass,type,name)

      $("#statetable tbody").append(row)

      $('.'+tooltipClass).tooltip();

      activatePopUpWindows(rowID,type)

    }

    step4HandleErrors()

  })

  $(document).on('click','.removeStateRow', function(){

    let elem = $(this).parents('tr').first();
    let rowID = elem.attr('id')

    window.states.splice( window.states.indexOf(rowID), 1 );

    removeAllPopoverOfID(rowID)
    
    //ALL SUB-ROWS
    $(document).find('tr[parentID='+rowID+']').each(function( index ) {

      let rowid = $(this).attr('id')

      removeAllPopoverOfID(rowid)
      
      $(this).remove()

    });

    elem.remove()

    //if no more row left
    let rowCount = $("#statetable tbody .mainrow").length

    if (rowCount==0) {

      $("#statetable tbody").append('<tr><td></td><td></td><td></td><td></td></tr>')
      
    }

    step4HandleErrors()

  })


  $(document).on('click','.removeStateSubRow', function(){

    let elem = $(this).parents('tr').first();
    let rowID = elem.attr('id')
    let parentID = elem.attr('parentID')

    removeAllPopoverOfID(rowID)

    elem.remove()

    //IF THIS IS THE LAST SUBROW THEN ADD PROP TD TO THE MAINROW
    let subRowCount = $(document).find('tr[parentID='+parentID+']').length

    if (subRowCount == 0) {
      let parentElem = $(document).find('tr[id='+parentID+']')
      let type = parentElem.attr('type')
      let td3 = makeStatesPropretiesTD(parentID)
      parentElem.removeClass('parentrow')
      parentElem.find('td').eq(2).html(td3)
      activatePopUpWindows(parentID,type)
    }

  })

  //*********************************
  //**************************STEP 4 END


  $(document).on('keyup', '.transitioninput', function() {

    let val = parseFloat($(this).val())


      let allinputs = $(this).parents('tr').first().find('input')
      let total = 0

      allinputs.each(function() {

        let v = $(this).val()

        if (v == "") {
          v = 0
        }

        let num = parseFloat(v)

        total = total + num

      });

      total = total.toFixed(2)

      let totaltext = $(this).parents('tr').first().find('.rowtotal').first()

      totaltext.find('.totalval').text(total)

      if (total != 1){
        totaltext.find('.msg').first().text('The total summation of the transition probabilities in one row must add up to 1')
      } else {
        totaltext.find('.msg').first().text('')
      }

        
  });

  //LAST STEP

  $(document).on('click','.show-info', function(){

    let message = $(this).find('span').first().attr('msg')


    if (message === 'undefined' || message === undefined) {
      if ($(this).hasClass('apop-info')) {
        message = 'The population type that is allowed to enter this resource/subresource'
      } else if($(this).hasClass('initpop-info')){
        message = 'The number of individuals that reside in this resource/subresource at the beginning of the simulation'
      } else if($(this).hasClass('maxl-info')){
        message = 'The population type that is allowed to enter this resource/subresource'
      } else if($(this).hasClass('cap-info')){
        message = 'The total number of individuals that can stay at this resource/subresource at any given time'
      }
    }

    window.info_Toast.fire({
      title: 'Info',
      text: message,
      icon: 'info',
    })

  });

})

function validateAllSteps(){

  let output = false

  if (checkStep1() && checkStep2() && checkStep3() && checkStep4() && checkStep6()) {

    output = true

  }

  return output

}


function checkStep1(){

  let output = {'flag':false,'message':''}

  if (window.loc == 1 && $('#simulation-name').val()) {

    let simname = $('#simulation-name').val();

    if (NoSpecialCharacter(simname)) {

      $('#loc-overview').text('Complete').addClass('text-success').removeClass('text-danger')

      $('#loc-div').removeClass('hide')

      $('#simname-side').text( simname )
      $('#cityname-side').text( $('#autocomplete').val() )

      output['flag'] = true

      return output

    } else {

      output['message'] = 'Simulation name cannot contain special characters'

      $('#loc-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')

      $('#loc-div').addClass('hide')

      $('#simname-side').text('')
      $('#cityname-side').text('')

      return output

    }

  } else {

    $('#loc-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')

    $('#loc-div').addClass('hide')

    $('#simname-side').text('')
    $('#cityname-side').text('')

    output['message'] = 'Simulation name and the city name are required'

    return output

  }
  
}

function step1HandleErrors(){

  let simname = $('#simulation-name').val();

  let nameValidated = false
  let cityValidated = false

  if (simname=="" || !NoSpecialCharacter(simname)) {
    $('#simname-error').css('display','block')
    nameValidated = false
  } else {
    $('#simname-error').css('display','none')
    nameValidated = true
  }

  if (window.loc != 1) {
    $('#cityname-error').css('display','block')
    cityValidated = false
  } else {
    $('#cityname-error').css('display','none')
    cityValidated = true
  }

  if (nameValidated && cityValidated) {
    $('#next').removeAttr('disabled')
  } else {
    $('#next').attr('disabled','true')
  }
  
}


function step2HandleErrors(){

  let typesInput = false

  if (window.populationType.length >= 1) {

    typesInput = true

  }

  if (typesInput) {
    $('#next').removeAttr('disabled')
  } else {
    $('#next').attr('disabled','true')
  }
  
}
function step3HandleErrors(){

  let resourcesSet = false

  if (window.resources.length >= 1) {

    resourcesSet = true

  }

  if (resourcesSet) {
    $('#next').removeAttr('disabled')
  } else {
    $('#next').attr('disabled','true')
  }
  
}
function step4HandleErrors(){

  let statesSet = false

  if (window.states.length >= 1) {

    statesSet = true

  }

  if (statesSet) {
    $('#next').removeAttr('disabled')
  } else {
    $('#next').attr('disabled','true')
  }
  
}
function step5HandleErrors(){


  let nameVal = $('#cname').val() 
  let weeksVal = $('#simweeks').val()
  let simnumVal = $('#simnum').val()

  let personNameInput = false
  let weeksInput = false
  let simNumInput = false

  if (nameVal=="" || !NoSpecialCharacter(nameVal)) {
    $('#personname-error').css('display','block')
    personNameInput = false
  } else {
    $('#personname-error').css('display','none')
    personNameInput = true
  }

  if (weeksVal=="" || !NoSpecialCharacter(weeksVal)) {
    $('#weeks-error').css('display','block')
    weeksInput = false
  } else {
    $('#weeks-error').css('display','none')
    weeksInput = true
  }

  if (simnumVal=="" || !NoSpecialCharacter(simnumVal)) {
    $('#simnum-error').css('display','block')
    simNumInput = false
  } else {
    $('#simnum-error').css('display','none')
    simNumInput = true
  }

  if (personNameInput && weeksInput && simNumInput) {
    $('#parameters-overview').text('Complete').addClass('text-success').removeClass('text-danger')
    $('#next').removeAttr('disabled')
  } else {
    $('#parameters-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')
    $('#next').attr('disabled','true')
  }
  
}

function checkStep2(){

  let output = false

  if (window.populationType.length >= 1) {

    $('#population-overview').text('Complete').addClass('text-success').removeClass('text-danger')

    output = true

    let infoSectionPopulationTable = ''
    
    $.each( window.populationType, function( k1, value ) {

      let thisPopulationVal = $(document).find('#population-'+value).val()

      infoSectionPopulationTable += '<tr><td>'+value+'</td>'+
              '<td>'+thisPopulationVal+'</td></tr>';

    });



    $('#population-info-table').css('display','block');
    $('#population-info-table table tbody').html(infoSectionPopulationTable);

  } else {

    $('#population-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')
    $('#population-info-table').css('display','none');
    $('#population-info-table table tbody').html('');

  }
  
  return output

}

function checkStep3(){

  let output = {'flag':false,'message':''}

  if (window.resources.length >= 1) {

    let unsetRows = $(document).find('#restable').find('.not-set').length

    if (unsetRows!=0) {

      output['message'] = "1 or more properties are not set!"

    } else {

      $('#resources-overview').text('Complete').addClass('text-success').removeClass('text-danger')
      output['flag'] = true

    }



  } else {

    output['message'] = "At least 1 resource is required!"

    $('#resources-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')

  }

  return output

}

function checkStep4(){

  let output = {'flag':false,'message':''}

  if (window.states.length >= 1) {

    let unsetRows = $(document).find('#statetable').find('.not-set').length

    if (unsetRows!=0) {

      output['message'] = "1 or more properties are not set!"

    } else {

      $('#states-overview').text('Complete').addClass('text-success').removeClass('text-danger')
      output['flag'] = true

    }

  } else {

    output['message'] = "At least 1 additional states is required!"

    $('#states-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')

  }

  return output

}


function checkStep5(){

  let output = false;

  let transitionInput = $(document).find('.transitioninput');

  let flag = true;

  transitionInput.each(function(){

    if ( $(this).val() == "" ){
      flag = false
    }

  });

  if (flag) {

    output = true

    $('#transitions-overview').text('Complete').addClass('text-success').removeClass('text-danger')

  } else {

    $('#transitions-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')

  }

  return output

}

function checkStep6(){

  let output = false

  if ($('#simweeks').val() && $('#simnum').val() && $('#cname').val() ) {

    output = true

    $('#parameters-overview').text('Complete').addClass('text-success').removeClass('text-danger')


  } else {

    $('#parameters-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')

  }
  
  return output

}

function  removeDuplicate(myarray){
  let uniqueNames = []
  $.each(myarray, function(i, el){
      if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
  });
  return uniqueNames

}

function makeid(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;

}

function activatePopUpWindows(rowID,type){

  let apopID = 'apop-'+rowID
  let ipopID = 'ipop-'+rowID
  let mpopID = 'mpop-'+rowID
  let cpopID = 'cpop-'+rowID

  $(document).find('#'+apopID).popover({html:true,title: "Allowed Population Type <a class='show-info pointer apop-info'><span></span><i class='text-info fas fa-info-circle'></i></a> <a class='dismisspopover close' data-dismiss='alert'>&times;</a>"}).click(function(e) {
      $('.popover').not(this).hide();
      $(this).data("bs.popover").inState.click = false;
      $(this).popover('show');
      e.preventDefault();
  });

  $(document).find('#'+ipopID).popover({html:true,title: "Initial Population Count <a class='show-info pointer initpop-info'><span></span><i class='text-info fas fa-info-circle'></i></a> <a class='dismisspopover close' data-dismiss='alert'>&times;</a>"}).click(function(e) {
      $('.popover').not(this).hide();
      $(this).data("bs.popover").inState.click = false;
      $(this).popover('show');
      e.preventDefault();
  });

  let _type = 'state'
  if (type=="res") {

    _type = 'resource'

    $(document).find('#'+mpopID).popover({html:true,title: "Maximum Length of Stay <a class='show-info pointer maxl-info'><span></span><i class='text-info fas fa-info-circle'></i></a> <a class='dismisspopover close' data-dismiss='alert'>&times;</a>"}).click(function(e) {
        $('.popover').not(this).hide();
        $(this).data("bs.popover").inState.click = false;
        $(this).popover('show');
        e.preventDefault();
    });

    $(document).find('#'+cpopID).popover({html:true,title: "Capacity <a class='show-info pointer cap-info'><span></span><i class='text-info fas fa-info-circle'></i></a> <a class='dismisspopover close' data-dismiss='alert'>&times;</a>"}).click(function(e) {
        $('.popover').not(this).hide();
        $(this).data("bs.popover").inState.click = false;
        $(this).popover('show');
        e.preventDefault();
    });

  }

  addApopHTML(apopID,rowID,_type)
  addIpopHTML(ipopID,rowID,_type)
  addMpopHTML(mpopID,rowID,_type)
  addCpopHTML(cpopID,rowID,_type)

}

function addApopHTML(ThisID,rowID,_type){

  let html = '<div><div class="table-responsive">'+
     '<table id="'+ThisID+'" class="table table-bordered">'+
        '<thead>'+
          '<tr>'+
            '<th>Population Type</th><th>Allowed</th>'+
          '</tr>'+
        '</thead>'+
        '<tbody>';

  $.each( window.populationType, function( k1, value ) {

    html += '<tr><td class="pop" style="font-weight: 900">'+value+'</td>'+
            '<td class="pop"><label class="checkbox-inline"><input kind="'+_type+'" name="allowedPopulation['+_type+']['+rowID+']['+value+']" class="ana" type="checkbox" value="'+value+'" checked> Allowed</label></td></tr>';

  });

  html +=   '</tbody></table></div><div style="width:100%"><a type="ap" id="'+ThisID+'" class="closepop btn btn-xs btn-primary text-white pointer">Save and Close</a></div></div>';


  if(typeof window.popovers[ThisID] === 'undefined') {
    window.popovers[ThisID] = html
  }

  $(document).find('#'+ThisID).on('shown.bs.popover', function () {

    let popid = $(this).attr('aria-describedby')

    let thisid = $(this).attr('id')

    $(document).find('#'+popid).first().find('.popover-content').first().html(window.popovers[thisid]);

  })

}

function addIpopHTML(ThisID,rowID,_type){

  let html = '<div><div class="table-responsive">'+
     '<table id="'+ThisID+'" class="table table-bordered"><tbody>';

  $.each(window.populationType, function( k1, value ) {

    html += ReturnIpopTR(value,rowID,_type)

  });

  html += '</tbody></table></div><div style="width:100%"><a id="'+ThisID+'" class="closepop btn btn-xs btn-primary text-white pointer">Save and Close</a></div></div>';


  if(typeof window.popovers[ThisID] === 'undefined') {
    window.popovers[ThisID] = html
  }


  $(document).find('#'+ThisID).on('shown.bs.popover', function () {

    let popid = $(this).attr('aria-describedby')

    let thisid = $(this).attr('id')

    $(document).find('#'+popid).first().find('.popover-content').first().html(window.popovers[thisid]);

  })

}

function addCpopHTML(ThisID,rowID,_type){

  let html =  '<div><div class="table-responsive">'+
          '<table id="'+ThisID+'" class="table table-bordered"><tbody>';

  html += '<tr><td class="pop" style="font-weight: 900">Capacity</td>'+
          '<td class="pop" ><input class="capacity-inputs capacity-input-validation" name="capacity['+_type+']['+rowID+']" style="width:100px; height:100%;" placeholder="#" value="1" type="number" min="1" max="100000" step="1">'+
          '<br><label class="checkbox-inline"><input thisid="'+rowID+'" class="capacities-infinite" name="capacityCheckBox['+_type+']['+rowID+']" class="infinitx" type="checkbox"> Infinite</label>'+
          '</td></tr>';

  html +=   '</tbody></table></div><div style="width:100%"><a id="'+ThisID+'" class="closepop btn btn-xs btn-primary text-white pointer">Save and Close</a></div></div>';


  if(typeof window.popovers[ThisID] === 'undefined') {
    window.popovers[ThisID] = html
  }

  $(document).find('#'+ThisID).on('shown.bs.popover', function () {

    let popid = $(this).attr('aria-describedby')

    let thisid = $(this).attr('id')

    $(document).find('#'+popid).first().find('.popover-content').first().html(window.popovers[thisid]);

  })

}

function addMpopHTML(ThisID,rowID,_type){

  let html =  '<div><div class="table-responsive">'+
          '<table id="'+ThisID+'" class="table table-bordered"><tbody>';

  html += '<tr><td class="pop" style="font-weight: 900">Maximum Length of Stay (weeks)</td>'+
            '<td class="pop"><input class="maxlength-input-validation" type="number" min="1" max="1000" step="1" name="maximumlengthofstay['+_type+']['+rowID+']" value="7" style="width:100px; height:100%;" placeholder="#"></td></tr>';

  html +=   '</tbody></table></div><div style="width:100%"><a id="'+ThisID+'" class="closepop btn btn-xs btn-primary text-white pointer">Save and Close</a></div></div>';


  if(typeof window.popovers[ThisID] === 'undefined') {
    window.popovers[ThisID] = html
  }

  $(document).find('#'+ThisID).on('shown.bs.popover', function () {

    let popid = $(this).attr('aria-describedby')

    let thisid = $(this).attr('id')

    $(document).find('#'+popid).first().find('.popover-content').first().html(window.popovers[thisid]);

  })

}


function updateIpopHTML(populationArray,rootID,_type){

  let ThisID = 'ipop-'+rootID

  let html = '<div><div class="table-responsive">'+
     '<table id="'+ThisID+'" class="table table-bordered"><tbody>';

  $.each(populationArray, function( k1, value ) {

    html += ReturnIpopTR(value,rootID,_type)

  });

  html +=   '</tbody></table></div><div style="width:100%"><a id="'+ThisID+'" class="closepop btn btn-xs btn-primary text-white pointer">Save and Close</a></div></div>';


  if(typeof window.popovers[ThisID] !== 'undefined') {
    window.popovers[ThisID] = html
  }

  $(document).find('#'+ThisID).on('shown.bs.popover', function () {

    let popid = $(this).attr('aria-describedby')

    let thisid = $(this).attr('id')

    $(document).find('#'+popid).first().find('.popover-content').first().html(window.popovers[thisid]);

  })

}

function ReturnIpopTR(value,rowID,_type){
  let html = '<tr name="'+value+'"><td class="pop" style="font-weight: 900">'+value+'</td>'+
            '<td class="pop"><input class="initpop-input-validation initpop-input-'+rowID+'" type="number" min="0" max="100000" step="1" value="0" name="initialPopulation['+_type+']['+rowID+']['+value+']" style="width:100px; height:100%;" placeholder="#"></td></tr>';
  return html;
}

function makeResourcesPropretiesTD(rowID,tooltipClass){
  let html =  '<ul class="mb0"><li><a id="apop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Allowed Population Type</a>'+
              '&nbsp;<a data-toggle="tooltip" data-placement="top" title="Not set" class="not-set pointer '+tooltipClass+'"><i class="text-danger fas fa-times-circle"></i></a>'+
              '</li>'+

              '<li><a id="ipop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Initial Population Count</a>'+
              '&nbsp;<a data-toggle="tooltip" data-placement="top" title="Not set" class="not-set pointer '+tooltipClass+'"><i class="text-danger fas fa-times-circle"></i></a>'+
              '</li>'+

              '<li><a id="mpop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Maximum Length of Stay</a>'+
              '&nbsp;<a data-toggle="tooltip" data-placement="top" title="Not set" class="not-set pointer '+tooltipClass+'"><i class="text-danger fas fa-times-circle"></i></a>'+
              '</li>'+

              '<li><a id="cpop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Capacity</a>'+
              '&nbsp;<a data-toggle="tooltip" data-placement="top" title="Not set" class="not-set pointer '+tooltipClass+'"><i class="text-danger fas fa-times-circle"></i></a>'+
              '</li>';

  return html
}

function makeStatesPropretiesTD(rowID,tooltipClass){
  let html =  '<ul class="mb0"><li><a id="apop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Allowed Population Type</a>'+
              '&nbsp;<a data-toggle="tooltip" data-placement="top" title="Not set" class="not-set pointer '+tooltipClass+'"><i class="text-danger fas fa-times-circle"></i></a>'+
              '</li>'+

              '<li><a id="ipop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Initial Population Count</a>'+
              '&nbsp;<a data-toggle="tooltip" data-placement="top" title="Not set" class="not-set pointer '+tooltipClass+'"><i class="text-danger fas fa-times-circle"></i></a>'+
              '</li>';

  return html
}

function HandleStepsOnNextBtnClick(){

  let step = window.currentstep

  switch(step){

    //LOCATION
    case 1:

      let output = checkStep1();

      if (output['flag']) {
        $('#smartwizard').smartWizard("next")
      } else {
        window.Toast.fire({
        title: 'Error',
        text: output['message'],
        icon: 'error',
        })
      }

    break;

    //POPULATION
    case 2:

      if (checkStep2()) {
        $('#smartwizard').smartWizard("next")
      } else {
        Toast.fire({
          title: 'Error',
          text: "Population type is required!",
          icon: 'warning'
        })
      }

    break;

    //RESOURCES
    case 3:

      let validate = checkStep3()

      if (validate['flag']===true) {
        $('#smartwizard').smartWizard("next")
      } else {
        Toast.fire({
          title: 'Error',
          text: validate['message'],
          icon: 'warning'
        })
      }

    break;

    //STATES
    case 4:

      let stateValidate = checkStep4()

      if (stateValidate['flag']===true) {
        $('#smartwizard').smartWizard("next")
      } else {
        Toast.fire({
          title: 'Error',
          text: stateValidate['message'],
          icon: 'warning'
        })
      }

    break;

    //PRAMETERS
    case 5:
      if (checkStep6()) {

        if (validateAllSteps()) {

          InsertArrayElementToDOM(window.populationType,'#myform','populationType')

          Object.keys(window.popovers).forEach(function(key) {

            $('#popoverhtmls').append(window.popovers[key])

          });

          $('#myform').submit()

        } else {

          Toast.fire({
            title: 'Error',
            text: "One or more steps are incomplete!",
            icon: 'warning'
          })

        }

      } else {
        Toast.fire({
        title: 'Error',
        text: "All parameters are required!",
        icon: 'warning'
        })
      }

    break;
  }

}

function MakeResourcesRowColumnHTML(rowID,tooltipClass,type,name,nameForShow){
  let rowCount = $("#restable tbody tr").length

  let tr = '<tr id="'+rowID+'" class="mainrow" count="'+rowCount+'" type="'+type+'" name="'+name+'">';
  let td0 = '<td kind="name">'+nameForShow+'</td>';

  let td1 = '<td kind="nameinput"><input type="text" class="form-control no-special-chars" name="resources['+rowID+'][name-for-show]" value="'+nameForShow+'">'+
            '<input type="hidden" class="form-control" name="resources['+rowID+'][name]" value="'+name+'">'+
            '<small class="text-danger hide">* duplication name is not allowed</small></td>';
  
  let td2 = '<td kind="action">'+
            '<a class="text-link divideRes pointer">Add sub-element&nbsp;<a class="show-info pointer"><span msg="This feature divides this resource into multiple resources"></span><i class="text-info fas fa-info-circle"></i></a></a>'+
            '</td>'

  let td3 = '<td kind="props">'+makeResourcesPropretiesTD(rowID,tooltipClass)+'</td>'

  let td4 = '<td kind="action">'+
            '<a class="text-danger pointer removeResRow">Delete row</a>'+
            '</td>'

  let row =   tr+
              td0+
              td1+
              td2+
              td3+
              td4+
              '</tr>';
  return row;
}

function MakeSUBResourcesRowColumnHTML(rowID,parentID,subRowCount,tooltipClass,parentName){
  let _class = ""
  if (subRowCount!=0) 
    _class = 'nthsub'

  let tr = '<tr id="'+rowID+'" parentID="'+parentID+'" class="sub '+_class+'" count="'+subRowCount+'">'
  let td0 = '<td>Sub '+parentName+'</td>';
  let td1 = '<td><input type="text" class="form-control no-special-chars" name="subresources['+parentID+']['+rowID+'][name]" placeholder="Sub '+parentName+'"><small class="text-danger hide">* duplication name is not allowed</small></td>'
  let td2 = '<td></td>'
  let td3 = '<td>'+makeResourcesPropretiesTD(rowID,tooltipClass)+'</td>'
  let td4 = '<td><a class="text-danger pointer removeResSubRow">Delete row&nbsp;</a></td>'
  let row =   tr+
              td0+
              td1+
              td2+
              td3+
              td4+
              '</tr>';
  return row;
}

function MakeStatesRowColumnHTML(rowID,tooltipClass,type,name){
  let rowCount = $("#statetable tbody tr").length
  let tr = '<tr id="'+rowID+'" class="mainrow" count="'+rowCount+'" type="'+type+'" name="'+name+'">';
  let td0 = '<td>'+name+'</td>';

  let td1 = '<td><input type="text" class="form-control no-special-chars" name="states['+rowID+'][name-for-show]" value="'+name+'">'+
            '<input type="hidden" class="form-control" name="states['+rowID+'][name]" value="'+name+'">'+
            '<small class="text-danger hide">* duplication name is not allowed</small></td>';

  let td3 = '<td>'+makeStatesPropretiesTD(rowID,tooltipClass)+'</td>'
  let td4 = '<td><a class="text-danger pointer removeStateRow">Delete row</a></td>'
  let row =   tr+
              td0+
              td1+
              td3+
              td4+
              '</tr>';
  return row;
}


function MakeTransitionalPropTable(){

  let arr = []

  Object.keys(window.resources).forEach(function(key) {

    Object.keys(window.resources[key]).forEach(function(key2) {

      arr.push(window.resources[key][key2])

    });

  });

  Object.keys(window.states).forEach(function(key) {

    Object.keys(window.states[key]).forEach(function(key2) {

      arr.push(window.states[key][key2])

    });

  });


  arr = removeDuplicate(arr)

  html = '<div class="table-responsive">'+
  '<table id="transprop" class="table table-bordered">'+
  '<thead>'+
  '<tr><th></th>';


  $.each( arr, function( k1, value ) {

    html += '<th>'+value+'</th>';

  });

  html += '<th>Total</th>';

  html += '</tr>'+
  '</thead>'+
  '<tbody>';

  $.each( arr, function( k1, v1 ) {

    html += '<tr><td class="titles">'+v1+'</td>';

    $.each( arr, function( k1, v2 ) {

      html += '<td><input name="TransitionProbability['+v1+']['+v2+']" id="'+v1+'-'+v2+'" type="text" class="form-control transitioninput no-special-chars" placeholder="0 to 1"></td>';

    });

    html += '<td class="rowtotal"><p class="totalval">0</p><p><small class="msg" style="color:red"></small></p></td>';

    html += '</tr>';

  });


  html += '</tbody></table></div>';

  $('#transitiontable').html(html)

}

function InsertArrayElementToDOM(array,elem,inputName){

  $(document).find('.'+inputName+'-input').remove()

  let i = 0;
  for (i = 0; i < array.length; i++) {
    $(elem).append('<input type="hidden" class="'+inputName+'-input" name="'+inputName+'['+i+']" value="'+array[i]+'">')
  }

}

function removeAllPopoverOfID(rowID){
  let apopID = 'apop-'+rowID
  let ipopID = 'ipop-'+rowID
  let mpopID = 'mpop-'+rowID
  let cpopID = 'cpop-'+rowID

  delete window.popovers[apopID]
  delete window.popovers[ipopID]
  delete window.popovers[mpopID]
  delete window.popovers[cpopID]
}

function NoSpecialCharacter(str){

    var regex = new RegExp("^[ a-zA-Z0-9]+$");
    if (!regex.test(str) ) {
      return false;
    } else {
      return true;
    }

}