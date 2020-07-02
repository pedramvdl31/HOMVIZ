window.populationType = []
window.states = []
window.resources = []

window.tableFlagstate = 0
window.currentstep = 0
window.popovers = {}

//validation
window.loc = 0
window.stateset = 0
window.params = 0

//debug
window.debug = 0

$('.general-info').tooltip();

$(document).ready(function(){

  $("#mcontent").css("display","block")

  $('#smartwizard').smartWizard({
    selected: 0,
    theme: 'arrows',
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

    if (window.currentstep==5) {

      $('#next').text('Run Simulation')

    }

    if (window.currentstep==1) {

      $('#prev').attr('disabled','true')

    } else {

      $('#prev').removeAttr('disabled','true')

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


  //*********************************
  //**************************STEP 2

  $('#populationbtn').on('click', function(e) {

    if ($("#populationtext").val().length != 0){

      let popTableTbody = $('#_table #populationtable tbody')
      popTableTbody.html("")

      $('#populationbtn').attr('disabled','true')
      let input_val = $("#populationtext").val()

      window.populationType = []
      let tableRow = ''

      let input_separated = input_val.split(',')

      $.each( input_separated, function( k1, value ) {

        value = value.trim()

        window.populationType.push(value)

        tableRow +=   '<tr>'+
                    '<td style="font-weight: 900">'+value+'</td>'+
                    '<td class="ttd"><input id="population-'+value+'" type="text" class="form-control" name="populationTypeCount['+value+']" style="width:100px; height:100%;" value="0">'+
                    '</td></tr>';

      });

      popTableTbody.append(tableRow)

      $('#pop-count-info').css('display','inline-block')
      $('#pop-count-info').parents('th').first().addClass('animate__animated animate__headShake')

    }

  });


  $(document).on("click","#removepopulationtable",function() {

    let popTableTbody = $('#_table #populationtable tbody')
    popTableTbody.html("<tr><td></td><td></td></tr>")

    window.populationType = []

    $('#populationbtn').removeAttr('disabled')
    $('#pop-count-info').css('display','none')
    $('#pop-count-info').parents('th').first().removeClass('animate__animated animate__headShake')

  });


  //********************************
  //***********************STEP 2 END



  //*********************************
  //**************************STEP 3


  $('#resourcebtn').on('click', function(e) {

    var elem = document.getElementById("resselect");
    var id = elem.options[elem.selectedIndex].id;
    let name = elem.options[elem.selectedIndex].value;

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
      let row = MakeResourcesRowColumnHTML(rowID,tooltipClass,type,name)

      $("#restable tbody").append(row)

      $('.'+tooltipClass).tooltip();

      activatePopUpWindows(rowID,type)

    }

  })

  $(document).on("click",".closepop",function(e,data) {

    let id = $(this).attr('id')

    let html = $(this).parents('.popover-content').first().clone();

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

    $('.popover-all').popover('hide');

  });


  $(document).on("change",".capacities-infinite",function(e,data) {
    if(this.checked) {
      $(this).parents('td').first().find('.capacity-inputs').first().val('-1');
    } else {
      $(this).parents('td').first().find('.capacity-inputs').first().val('0');
    }
  });

  $(document).on("click",".divideRes",function(e,data) {

    let elem = $(this).parents('tr').first()

    let parentName = elem.attr('name')

    //Remove Propreties Column
    elem.find('td').eq(2).html('')

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

      $("#restable tbody").append('<tr><td></td><td></td><td></td><td></td></tr>')
      
    }

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

  })

  $(document).on("click",".divideState",function(e,data) {

    let elem = $(this).parents('tr').first()

    let parentName = elem.attr('name')

    //Remove Propreties Column
    elem.find('td').eq(2).html('')

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

    var obj = {};
    obj[rowID] = 'name';
    
    let tooltipClass= "tooltip-"+rowID

    let row = MakeSUBStatesRowColumnHTML(rowID,parentID,subRowCount,tooltipClass,parentName)

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

  $('#runsimulation').on('click', function(e){

  })

})

function validateAllSteps(){

  let output = false

  if (checkStep1() && checkStep2() && checkStep3() && checkStep4() && checkStep6()) {

    output = true

  }

  return output

}


function checkStep1(){

  let output = false

  if (window.loc == 1 && $('#simulation-name').val()) {

    $('#loc-overview').text('Complete').addClass('text-success').removeClass('text-danger')

    $('#loc-div').removeClass('hide')

    $('#simname-side').text( $('#simulation-name').val() )
    $('#cityname-side').text( $('#autocomplete').val() )

    output = true


  } else {

    $('#loc-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')

    $('#loc-div').addClass('hide')

    $('#simname-side').text('')
    $('#cityname-side').text('')

  }

  return output
  
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

  let output = false

  if (window.resources.length >= 1) {

    $('#resources-overview').text('Complete').addClass('text-success').removeClass('text-danger')

    output = true

  } else {

    $('#resources-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')

  }

  return output

}

function checkStep4(){

  let output = false

  if (window.states.length >= 1) {

    output = true

    $('#states-overview').text('Complete').addClass('text-success').removeClass('text-danger')


  } else {

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

  $(document).find('#'+apopID).popover({html:true,title: "Allowed Population Type"}).click(function(e) {
      $('.popover').not(this).hide();
      $(this).data("bs.popover").inState.click = false;
      $(this).popover('show');
      e.preventDefault();
  });

  $(document).find('#'+ipopID).popover({html:true,title: "Initial Population Count"}).click(function(e) {
      $('.popover').not(this).hide();
      $(this).data("bs.popover").inState.click = false;
      $(this).popover('show');
      e.preventDefault();
  });

  let _type = 'state'
  if (type=="res") {

    _type = 'resource'

    $(document).find('#'+mpopID).popover({html:true,title: "Maximum Length of Stay"}).click(function(e) {
        $('.popover').not(this).hide();
        $(this).data("bs.popover").inState.click = false;
        $(this).popover('show');
        e.preventDefault();
    });

    $(document).find('#'+cpopID).popover({html:true,title: "Capacity"}).click(function(e) {
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

  let html = '<div class="table-responsive">'+
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

  html +=   '</tbody></table></div><div style="width:100%"><a type="ap" id="'+ThisID+'" class="closepop a-tag">Save and Close</a></div>';


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

  let html = '<div class="table-responsive">'+
     '<table id="'+ThisID+'" class="table table-bordered"><tbody>';

  $.each(window.populationType, function( k1, value ) {

    html += ReturnIpopTR(value,rowID,_type)

  });

  html +=   '</tbody></table></div><div style="width:100%"><a id="'+ThisID+'" class="closepop a-tag">Save and Close</a></div>';


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

  let html =  '<div class="table-responsive">'+
          '<table id="'+ThisID+'" class="table table-bordered"><tbody>';

  html += '<tr><td class="pop" style="font-weight: 900">Capacity</td>'+
          '<td class="pop" ><input class="capacity-inputs" name="capacity['+_type+']['+rowID+']" style="width:100px; height:100%;" placeholder="#" value="0">'+
          '<br><label class="checkbox-inline"><input class="capacities-infinite" name="capacityCheckBox['+_type+']['+rowID+']" class="infinitx" type="checkbox"> Infinite</label>'+
          '</td></tr>';

  html +=   '</tbody></table></div><div style="width:100%"><a id="'+ThisID+'" class="closepop a-tag">Save and Close</a></div>';


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

  let html =  '<div class="table-responsive">'+
          '<table id="'+ThisID+'" class="table table-bordered"><tbody>';

  html += '<tr><td class="pop" style="font-weight: 900">Maximum Length of Stay (weeks)</td>'+
            '<td class="pop"><input name="maximumlengthofstay['+_type+']['+rowID+']" value="7" style="width:100px; height:100%;" placeholder="#"></td></tr>';

  html +=   '</tbody></table></div><div style="width:100%"><a id="'+ThisID+'" class="closepop a-tag">Save and Close</a></div>';


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

  let html = '<div class="table-responsive">'+
     '<table id="'+ThisID+'" class="table table-bordered"><tbody>';

  $.each(populationArray, function( k1, value ) {

    html += ReturnIpopTR(value,rootID,_type)

  });

  html +=   '</tbody></table></div><div style="width:100%"><a id="'+ThisID+'" class="closepop a-tag">Save and Close</a></div>';


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
            '<td class="pop"><input value="0" name="initialPopulation['+_type+']['+rowID+']['+value+']" style="width:100px; height:100%;" placeholder="#"></td></tr>';
  return html;
}

function makeResourcesPropretiesTD(rowID,tooltipClass){
  let html =  '<a id="apop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Allowed Population Type</a>'+
              '&nbsp;<a data-toggle="tooltip" data-placement="top" title="The population type that is allowed to enter this resource/subresource" class="pointer '+tooltipClass+'"><i class="text-primary fas fa-info-circle"></i></a>'+
              ',&nbsp;&nbsp;'+

              '<a id="ipop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Initial Population Count</a>'+
              '&nbsp;<a data-toggle="tooltip" data-placement="top" title="The number of individuals that reside in this resource/subresource at the beginning of the simulation" class="pointer '+tooltipClass+'"><i class="text-primary fas fa-info-circle"></i></a>'+
              ',&nbsp;&nbsp;'+

              '<a id="mpop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Maximum Length of Stay</a>'+
              '&nbsp;<a data-toggle="tooltip" data-placement="top" title="The maximum number of weeks in which one individual can continuously stay in this resource/subresource" class="pointer '+tooltipClass+'"><i class="text-primary fas fa-info-circle"></i></a>'+
              ',&nbsp;&nbsp;'+

              '<a id="cpop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Capacity</a>'+
              '&nbsp;<a data-toggle="tooltip" data-placement="top" title="The total number of individuals that can stay at this resource/subresource at any given time" class="pointer '+tooltipClass+'"><i class="text-primary fas fa-info-circle"></i></a>';

  return html
}

function makeStatesPropretiesTD(rowID,tooltipClass){
  let html =  '<a id="apop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Allowed Population Type</a>'+
              '&nbsp;<a data-toggle="tooltip" data-placement="top" title="The population type that is allowed to enter this resource/subresource" class="pointer '+tooltipClass+'"><i class="text-primary fas fa-info-circle"></i></a>'+
              ',&nbsp;&nbsp;'+

              '<a id="ipop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Initial Population Count</a>'+
              '&nbsp;<a data-toggle="tooltip" data-placement="top" title="The number of individuals that reside in this resource/subresource at the beginning of the simulation" class="pointer '+tooltipClass+'"><i class="text-primary fas fa-info-circle"></i></a>';

  return html
}

function HandleStepsOnNextBtnClick(){

  const Toast = Swal.mixin({
    toast: true,
    position: 'center',
    showConfirmButton: false,
    animation:true,
    timer: 2500
  });

  let step = window.currentstep

  switch(step){

    //LOCATION
    case 1:

      if (checkStep1()) {
        $('#smartwizard').smartWizard("next")
      } else {
        Toast.fire({
        title: 'Error',
        text: "Simulation name and the city name are required!",
        icon: 'warning'
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
        icon: 'warning',
          showConfirmButton: true,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Okay'
        })
      }

    break;

    //RESOURCES
    case 3:

      if (checkStep3()) {
        $('#smartwizard').smartWizard("next")
      } else {
        Toast.fire({
        title: 'Error',
        text: "At least 1 resource is required!",
        icon: 'warning',
          showConfirmButton: true,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Okay'
        })
      }

    break;

    //STATES
    case 4:

      if (checkStep4()) {
        MakeTransitionalPropTable()
        $('#smartwizard').smartWizard("next")
      } else {
        Toast.fire({
        title: 'Error',
        text: "At least 1 state is required!",
        icon: 'warning',
          showConfirmButton: true,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Okay'
        })
      }

    break;

    //TRANSITIONS
    // case 5:

    //   // if (checkStep5()) {
    //   if (true) {
    //     $('#smartwizard').smartWizard("next")
    //   } else {
    //     Toast.fire({
    //     title: 'Error',
    //     text: "Transition Probability is required!",
    //     icon: 'warning',
    //       showConfirmButton: true,
    //       confirmButtonColor: '#3085d6',
    //       confirmButtonText: 'Okay'
    //     })
    //   }

    // break;

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

          const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            animation:false
          });

          Toast.fire({
          title: 'Error',
          text: "One or more steps are incomplete!",
          icon: 'warning',
            showConfirmButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Okay'
          })

        }

      } else {
        Toast.fire({
        title: 'Error',
        text: "All parameters are required!",
        icon: 'warning',
        showConfirmButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Okay'
        })
      }

    break;
  }

}

function MakeResourcesRowColumnHTML(rowID,tooltipClass,type,name){
  let rowCount = $("#restable tbody tr").length

  let tr = '<tr id="'+rowID+'" class="mainrow" count="'+rowCount+'" type="'+type+'" name="'+name+'">';
  let td0 = '<td kind="name">'+name+'</td>';
  let td1 = '<td kind="nameinput"><input type="text" class="form-control" name="resources['+rowID+'][name]" value="'+name+'"><small class="text-danger hide">* duplication name is not allowed</small></td>';
  let td3 = '<td kind="props">'+makeResourcesPropretiesTD(rowID,tooltipClass)+'</td>'
  let td4 = '<td kind="action"><a data-toggle="tooltip" data-placement="top" title="Add Sub Resources" class="divideRes pointer '+tooltipClass+'"><i class="text-primary fas fa-layer-group"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a data-toggle="tooltip" data-placement="top" title="Delete Row" class="pointer removeResRow '+tooltipClass+'"><i class="text-danger fas fa-minus-square"></i></a></td>'

  let row =   tr+
              td0+
              td1+
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
  let td1 = '<td><input type="text" class="form-control" name="subresources['+parentID+']['+rowID+'][name]" placeholder="Sub '+parentName+'"><small class="text-danger hide">* duplication name is not allowed</small></td>'
  let td4 = '<td><a data-toggle="tooltip" data-placement="top" title="Delete Row" class="pointer removeResSubRow '+tooltipClass+'"><i class="text-danger fas fa-minus-square"></i></a></td>'
  let td3 = '<td>'+makeResourcesPropretiesTD(rowID,tooltipClass)+'</td>'
  let row =   tr+
              td0+
              td1+
              td3+
              td4+
              '</tr>';
  return row;
}

function MakeStatesRowColumnHTML(rowID,tooltipClass,type,name){
  let rowCount = $("#statetable tbody tr").length
  let tr = '<tr id="'+rowID+'" class="mainrow" count="'+rowCount+'" type="'+type+'" name="'+name+'">';
  let td0 = '<td>'+name+'</td>';
  let td1 = '<td><input type="text" class="form-control" name="states['+rowID+'][name]" value="'+name+'"><small class="text-danger hide">* duplication name is not allowed</small></td>';
  let td3 = '<td>'+makeStatesPropretiesTD(rowID,tooltipClass)+'</td>'
  let td4 = '<td><a data-toggle="tooltip" data-placement="top" title="Add Sub State" class="divideState pointer '+tooltipClass+'"><i class="text-primary fas fa-layer-group"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a data-toggle="tooltip" data-placement="top" title="Delete Row" class="pointer removeStateRow '+tooltipClass+'"><i class="text-danger fas fa-minus-square"></i></a></td>'
  let row =   tr+
              td0+
              td1+
              td3+
              td4+
              '</tr>';
  return row;
}

function MakeSUBStatesRowColumnHTML(rowID,parentID,subRowCount,tooltipClass,parentName){
  let _class = ""
  if (subRowCount!=0) 
    _class = 'nthsub'

  let tr = '<tr id="'+rowID+'" parentID="'+parentID+'" class="sub '+_class+'" count="'+subRowCount+'">'
  let td0 = '<td>Sub '+parentName+'</td>';
  let td1 = '<td><input type="text" class="form-control" name="substates['+parentID+']['+rowID+'][name]" placeholder="Name (unique)"><small class="text-danger hide">* duplication name is not allowed</small></td>'
  let td4 = '<td><a data-toggle="tooltip" data-placement="top" title="Delete Row" class="pointer removeStateSubRow '+tooltipClass+'"><i class="text-danger fas fa-minus-square"></i></a></td>'
  let td3 = '<td>'+makeStatesPropretiesTD(rowID,tooltipClass)+'</td>'
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

      html += '<td><input name="TransitionProbability['+v1+']['+v2+']" id="'+v1+'-'+v2+'" type="text" class="form-control transitioninput" placeholder="0 to 1"></td>';

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