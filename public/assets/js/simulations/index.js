function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if (navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    } else {
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}

// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

window.populationType = []
window.states = []
window.resources = []
window.loc = 0
window.population = 0
window.stateset = 0
window.resset = 0
window.params = 0
window.tableFlagstate = 0
window.tableFlagres = 0
window.currentstep = 0
window.popovers = {}

window.debug = 0

function btnStatus(){

  if (window.loc == 1 && window.population == 1 && window.stateset == 1&& window.resset == 1 && window.params == 1) {

    $('#runsimulation').addClass('btn-primary').removeClass('btn-default').removeAttr('disabled')


  } else {

    $('#runsimulation').addClass('btn-default').removeClass('btn-primary').attr('disabled',true)

  }

}

function checkLoc(){

  if (window.loc == 1) {

    $('#loc-overview').text('Set').addClass('text-success').removeClass('text-danger')

    $('#loc-div').removeClass('hide')


  } else {

    $('#loc-overview').text('Not Set').addClass('text-danger').removeClass('text-success')

    $('#loc-div').addClass('hide')

  }

 btnStatus()
  
}

function resetTransitionProbTable(){


  window.resources = removeDuplicate(window.resources)
  window.states = removeDuplicate(window.states)

  let arr = []

  arr = arr.concat(window.states,window.resources)


  html = '<div class="table-responsive">'+
  '<table id="transprop" class="table table-bordered">'+
  '<thead>'+
  '<tr><th></th>';


  $.each( arr, function( k1, value ) {

  html += '<th>'+value+'</th>';

  });

  html += '</tr>'+
  '</thead>'+
  '<tbody>';

  $.each( arr, function( k1, v1 ) {

    html += '<tr><td class="titles">'+v1+'</td>';

    $.each( arr, function( k1, v2 ) {

      html += '<td><input id="'+v1+'-'+v2+'" type="text" class="form-control" placeholder="0 to 1" value="0"></td>';

    });

    html += '</tr>';

  });


  html += '</tbody></table></div>';

  $('#transitiontable').html(html)

}

function checkpopulation(){

  window.population = 1

  if (window.population == 1) {

    $('#population-overview').text('Set').addClass('text-success').removeClass('text-danger')


  } else {

    $('#population-overview').text('Not Set').addClass('text-danger').removeClass('text-success')

  }
    btnStatus()

}

function checkstate(){

  if (window.states.length > 0) {

    window.stateset = 1

    $('#state-overview').text('Set').addClass('text-success').removeClass('text-danger')


  } else {

    window.stateset = 0

    $('#state-overview').text('Not Set').addClass('text-danger').removeClass('text-success')

  }

  btnStatus()

}

function checkres(){

  if (window.resources.length > 0) {

    window.resset = 1

    $('#res-overview').text('Set').addClass('text-success').removeClass('text-danger')


  } else {

    window.resset = 0

    $('#res-overview').text('Not Set').addClass('text-danger').removeClass('text-success')

  }

  btnStatus()

}

function checktranprob(){

  if (window.transprob == 1) {

    $('#transprob-overview').text('Set').addClass('text-success').removeClass('text-danger')

  } else {

    $('#transprob-overview').text('Not Set').addClass('text-danger').removeClass('text-success')

  }

  btnStatus()

}

function chackParamsStatus(){


  if (window.params == 1) {

    $('#params-overview').text('Set').addClass('text-success').removeClass('text-danger')


  } else {

    $('#params-overview').text('Not Set').addClass('text-danger').removeClass('text-success')

  }
    btnStatus()

}

function processPopulation(){

    if ($("#populationtext").val().length == 0){

      

    } else {

      checkpopulation()

      $('#_table').html("")

      _val = $("#populationtext").val()
      _exp = _val.split(',')

      _table = '<div class="table-responsive">'+
             '<table class="table table-bordered ">'+
              '<thead>'+
                '<tr>'+
                '<th>Population Type</th><th>Population Count #</th>';

      _hdntable = '<div class="table-responsive" style="display: none">'+
         '<table id="poptable" class="table table-bordered ">'+
            '<thead>'+
            '<tr>'+
            '<th>Population Type</th><th>Population Count # <small>This table represents the popolation count of each category.</small></th>';


      _table +=   '</tr>'+
        '</thead>'+
          '<tbody>';

      _hdntable +=  '</tr>'+
          '</thead>'+
            '<tbody>';


      window.populationType = []

      $.each( _exp, function( k1, value ) {

        window.populationType.push(value)

        ht =   '<tr>'+
                '<td style="font-weight: 900">'+value+'</td>'+
                '<td class="ttd"><input type="text" class="form-control" style="width:100px; height:100%;" value="0"></td></tr>';

        _hdntable += ht
        _table += ht

      });


      _table +=   '</tbody>'+
        '</table>'+
        '</div>';

      _hdntable +=  '</tbody>'+
            '</table>'+
            '</div>';

      $("#_table").append(_table)
      $("#_table").append(_hdntable)

    }
}

function  removeDuplicate(myarray){
  let uniqueNames = []
  $.each(myarray, function(i, el){
      if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
  });
  return uniqueNames
}

$(document).ready(function(){

    $("#mcontent").css("display","block")

   var keyStop = {
     8: ":not(input:text, textarea, input:file, input:password)", // stop backspace = back
     13: "input:text, input:password", // stop enter = submit 

     end: null
   };
   $(document).bind("keydown", function(event){
    var selector = keyStop[event.which];

    if(selector !== undefined && $(event.target).is(selector)) {
        event.preventDefault(); //stop event
    }
    return true;
   });

  // Set our default popover options
  $.fn.popover.Constructor.DEFAULTS.trigger = 'click';
  $.fn.popover.Constructor.DEFAULTS.placement = 'bottom';

  // Smart Wizard
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
    transitionSpeed: '100'
  });

  const Toast = Swal.mixin({
    toast: true,
    position: 'center',
    showConfirmButton: false,
    timer: 3000
  });

  $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {

    window.currentstep = stepNumber

    if (stepNumber==4 && window.stateset==1 && window.resset==1) {

      resetTransitionProbTable()
      
      window.transprob = 1

      checktranprob()

    }

    if (stepNumber==5) {

      $('#next').attr('disabled','true')

    } else {

      $('#next').removeAttr('disabled','true')

    }

    if (stepNumber==0) {
      
      $('#prev').attr('disabled','true')

    } else {

      $('#prev').removeAttr('disabled','true')

    }

  });

  if (!window.debug) {

    $('#smartwizard').smartWizard('reset');

    $('#next').on('click', function(e){

      switch(window.currentstep){

        case 0:

          if (window.loc == 1) {
            $('#smartwizard').smartWizard("next")
          } else {
            Toast.fire({
            type: 'error',
            title: 'Location is not set.'
            })
          }

        break;
        case 1:

          if (window.population == 1) {
            $('#smartwizard').smartWizard("next")
          } else {
            Toast.fire({
            type: 'error',
            title: 'Population is not set.'
            })
          }

        break;
        case 2:

          if (window.resset == 1) {
            $('#smartwizard').smartWizard("next")
          } else {
            Toast.fire({
            type: 'error',
            title: 'Resource is not set.'
            })
          }

        break;
        case 3:

          if (window.stateset == 1) {
            $('#smartwizard').smartWizard("next")
          } else {
            Toast.fire({
            type: 'error',
            title: 'State is not set.'
            })
          }

        break;
        case 4:

          if (window.transprob == 1) {
            $('#smartwizard').smartWizard("next")
          } else {
            Toast.fire({
            type: 'error',
            title: 'Transition Probabilities are not set.'
            })
          }

        break;
        case 5:


          if (window.params == 1) {
            
          } else {
            Toast.fire({
            type: 'error',
            title: 'Parameters  are not set.'
            })
          }

        break;

      }

    })



  } else {


    $('#next').on('click', function(e){

      $('#smartwizard').smartWizard("next")
        
    })

  }

  $('#prev').on('click', function(e){

      $('#smartwizard').smartWizard("prev")
      
  })

  $(document).on("keyup change","#simname,#simnum,#simweeks",function() {

    let v1 = $('#simname').val()
    let v2 = $('#simnum').val()
    let v3 = $('#simweeks').val()

    if ( v1 != "" && v2 != "" && v3 != "" ){

      window.params = 1

    } else {

      window.params = 0

    }

    chackParamsStatus()

  });

  $(document).on("change",".transiteradio",function() {

    let value = $(this).val();
    let _class = "table-success";
    if (value=='notallowed') _class = "table-danger"
    $(this).closest("td").removeClass("table-success table-danger").addClass(_class)

  });

  // ********************
  // POPULATION LISTENERS
  $('#populationtext, #populationbtn').on('keyup click', function(e) {

    if (e.type == 'click') {

       processPopulation()

    } else if (e.type == 'keyup') {

      if (event.keyCode === 13) {
        processPopulation()
      }

    }

  });
  // POPULATION LISTENERS END


  // *****************
  // STATE AND RESOURCES 
  $('#statebtn').on('click', function(e) {

    var elem = document.getElementById("stateselect");
    var id = elem.options[elem.selectedIndex].id;

    if (id != 'title'){

      let name = elem.options[elem.selectedIndex].value;

      let type = $('option[id='+id+']').attr('type')

      window.states.push(name)

      console.log(window.states)

      processState(name,id,type)

    }

  })

  $('#resourcebtn').on('click', function(e) {

    var elem = document.getElementById("resselect");
    var id = elem.options[elem.selectedIndex].id;

    if (id != 'title'){

      let name = elem.options[elem.selectedIndex].value;

      let type = $('option[id='+id+']').attr('type')

      window.resources.push(name)

      console.log(window.resources)

      processRes(name,id,type)

    }

  })

  $(document).on("keyup",".nameinput",function() {

    let elem = $(this)
    let v = $(this).val()
    let i = $(this).attr('rid')

    let f = 0

    $(document).find(".nameinput").each(function (index, value) {

      let this_val = $(this).val()

      if (this_val!="") {
      
        if ($(this).attr('rid') != i) {
            if (this_val==v) {
              f = 1
            }
        }

        if (f == 1) { 

          elem.addClass('text-danger')
          elem.next().removeClass('hide')

        } else {

          elem.removeClass('text-danger')
          elem.next().addClass('hide')

        }

      }

    });

    

  });

  function processState(name,id,type){

      if (window.tableFlagstate== 0) {
        window.tableFlagstate = 1
        $("#statetable tbody tr").remove()
      }

      let c = $("#statetable tbody tr").length
      let this_type_count = $('#statetable tbody tr[rowname='+id+']').length + 1

      let uid = id+'-'+c

      let tr = '<tr id="'+id+'-'+c+'" class="mainrow" count="'+c+'" rowname='+id+' type="'+type+'" fullname="'+name+'">';
      let td1 = '<td><input rid="'+id+'" type="text" class="form-control nameinput" name="stateresname" placeholder="Name (unique)" value="'+name+' '+this_type_count+'"><small class="text-danger hide">* duplication name is not allowed</small></td>';
      let td4 = '<td class="stname"><a class="divide pointer"><i class="text-primary fas fa-layer-group"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="pointer removeRow"><i class="text-danger fas fa-minus-square"></i></a></td>'


      let row =  tr+
                  td1+
                  '<td class="ttd" id="td-'+id+'"><a id="ppop-'+uid+'" class="a-tag popover-all" id="ip-'+id+'" data-placement="bottom" data-toggle="popover">Initial Population</a>,&nbsp;&nbsp;'+
                  '<a id="apop-'+uid+'" class="a-tag popover-all" id="ap-'+id+'" data-placement="bottom" data-toggle="popover">Allowed Population</a>'+
                  '</td>'+
                  td4+
                  '</tr>';

      $("#statetable tbody").append(row)

      activatePopUpWindows(type,uid)
      checkstate()

  }

  function processRes(name,id,type){

      if (window.tableFlagres== 0) {
        window.tableFlagres = 1
        $("#restable tbody tr").remove()
      }

      let c = $("#restable tbody tr").length
      let this_type_count = $('#restable tbody tr[rowname='+id+']').length + 1

      let uid = id+'-'+c

      let tr = '<tr id="'+id+'-'+c+'" class="mainrow" count="'+c+'" rowname='+id+' type="'+type+'" fullname="'+name+'">';
      let td1 = '<td><input rid="'+id+'" type="text" class="form-control nameinput" name="resname" placeholder="Name (unique)" value="'+name+' '+this_type_count+'"><small class="text-danger hide">* duplication name is not allowed</small></td>';
      let td4 = '<td class="stname"><a class="divide pointer"><i class="text-primary fas fa-layer-group"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="pointer removeRow"><i class="text-danger fas fa-minus-square"></i></a></td>'

      let row =   tr+
                  td1+
                  '<td class="ttd" id="td-'+id+'"><a id="ppop-'+uid+'" class="a-tag popover-all" id="ip-'+id+'" data-placement="bottom" data-toggle="popover">Initial Population</a>,&nbsp;&nbsp;'+
                  '<a id="apop-'+uid+'" class="a-tag popover-all" id="ap-'+id+'" data-placement="bottom" data-toggle="popover">Allowed Population</a>,&nbsp;&nbsp;'+
                  '<a id="capop-'+uid+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover" id="c-'+id+'">Capacity</a></span>'+
                  '<span id="ms-'+id+'">,&nbsp;&nbsp;<a id="maxstay-'+uid+'" class="a-tag popover-all" id="ipms-'+id+'" data-placement="bottom" data-toggle="popover">Maximum Length of Stay</a></span></td>'+
                  td4+
                  '</tr>';

      $("#restable tbody").append(row)

      activatePopUpWindows(type,uid)
      checkres()

  }

  
  $(document).on("click",".divide",function(e,data) {

    let elem = $(this).parents('tr').first()
    let rowcount = elem.attr('count')
    let name = elem.attr('fullname');
    let id = $(document).find('tr').length
    let rowname = elem.attr('rowname')
    let type = elem.attr('type');
    let parentId = elem.attr('id')

    let c = ($(document).find('tr[parentID='+parentId+']').length)+1

    let uid = parentId+'-'+c

    elem.addClass('hassub')

    let _class = ""

    if (c!=1) 
      _class = 'nthsub'

    let tr = '<tr id="'+uid+'" parentID="'+parentId+'" class="sub '+_class+'" count="'+c+'">'
    let td1 = '<td><input rid="'+id+'" type="text" class="form-control nameinput" name="stateresname" value="'+name+' Sub-'+c+'"><small class="text-danger hide">* duplication name is not allowed</small></td>'
    
    let td4 = '<td class="stname"><a class="pointer removeRow"><i class="text-danger fas fa-minus-square"></i></a></td>'

    let h = tr+
            td1+
            '<td class="ttd" id="td-'+id+'">'+
            '<a id="ppop-'+uid+'" class="a-tag popover-all" id="ip-'+id+'" data-placement="bottom" data-toggle="popover">Initial Population</a>,&nbsp;&nbsp;'+
            '<a id="apop-'+uid+'" class="a-tag popover-all" id="ap-'+id+'" data-placement="bottom" data-toggle="popover">Allowed Population</a>,&nbsp;&nbsp;'+
            '<a id="capop-'+uid+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover" id="c-'+id+'">Capacity</a></span>'+
            '<span id="ms-'+id+'">,&nbsp;&nbsp;<a id="maxstay-'+uid+'" class="a-tag popover-all" id="ipms-'+id+'" data-placement="bottom" data-toggle="popover">Maximum Length of Stay</a></span></td>'+
            td4+
            '</tr>';

    
    if (type == 'state') {

      h = tr+
          td1+
          '<td class="ttd" id="td-'+id+'">'+
          '<a id="ppop-'+uid+'" class="a-tag popover-all" id="ip-'+id+'" data-placement="bottom" data-toggle="popover">Initial Population</a>,&nbsp;&nbsp;'+
          '<a id="apop-'+uid+'" class="a-tag popover-all" id="ap-'+id+'" data-placement="bottom" data-toggle="popover">Allowed Population</a></td>'+
          td4+
          '</tr>';

    }

    if (c==1) {

      $(h).insertAfter(elem);

    } else {

      elem = $(document).find('tr[parentID='+parentId+']').last()

      elem.addClass('nthsub')

      $(h).insertAfter(elem);

    }

    activatePopUpWindows(type,uid)

  })


  $(document).on('click','.removeRow', function(){

    let elem = $(this).parents('tr').first();
    let fullname = elem.attr('fullname')
    let id = elem.attr('id')

    window.states.splice( window.states.indexOf(fullname), 1 );
    window.resources.splice( window.resources.indexOf(fullname), 1 );

    delete window.popovers['ppop-'+id]
    delete window.popovers['apop-'+id]
    delete window.popovers['capop-'+id]
    delete window.popovers['maxstay-'+id]

    console.log(window.popovers)

    elem.remove()

    checkres()
    checkstate()

  })

  function activatePopUpWindows(type,uid){

      console.log(uid)

      if (type=="res") {

        $(document).find('#maxstay-'+uid).popover({html:true,title: "Maximum Length of Stay"}).click(function(e) {
            $('.popover').not(this).hide();
            $(this).data("bs.popover").inState.click = false;
            $(this).popover('show');
            e.preventDefault();
        });

        $(document).find('#capop-'+uid).popover({html:true,title: "Capacity"}).click(function(e) {
            $('.popover').not(this).hide();
            $(this).data("bs.popover").inState.click = false;
            $(this).popover('show');
            e.preventDefault();
        });

      }

      $(document).find('#ppop-'+uid).popover({html:true,title: "Initial Population"}).click(function(e) {
          $('.popover').not(this).hide();
          $(this).data("bs.popover").inState.click = false;
          $(this).popover('show');
          e.preventDefault();
      });

      $(document).find('#apop-'+uid).popover({html:true,title: "Allowed Population"}).click(function(e) {
          $('.popover').not(this).hide();
          $(this).data("bs.popover").inState.click = false;
          $(this).popover('show');
          e.preventDefault();
      });

      addppopHTML(uid)
      addcpopHTML(uid)
      addmaxstaypopHTML(uid)
      addapopHTML(uid)

  }

  // *****************
  // STATE AND RESOURCES End

  $(document).on("click",".closepop",function(e,data) {

    let id = $(this).attr('id')

    let html = $(this).parents('.popover-content').first().clone();

    console.log(html)

    if(typeof window.popovers[id] !== 'undefined') {
      window.popovers[id] = html
    }


    $('.popover-all').popover('hide');

  });

  $("#toexcel").click(function(){

    // exportTableToExcel('statetable', 'data')

  });

  $("#adddataanchor").click(function(){

    $('#uploadwrapper').addClass("show").removeClass("hide");

  });

  function addapopHTML(uid){

    uid = 'apop-'+uid;

    html = '<div id="tip-'+uid+'" class="table-responsive">'+
       '<table id="'+uid+'" class="table table-bordered">'+
          '<thead>'+
            '<tr>'+
              '<th>Population Type</th><th>Allowed</th>'+
            '</tr>'+
          '</thead>'+
          '<tbody>';

    $.each( window.populationType, function( k1, value ) {

      html += '<tr><td class="pop" style="font-weight: 900">'+value+'</td>'+
              '<td class="ttd pop"><label class="checkbox-inline"><input class="ana" name="ap-po-'+k1+'" type="checkbox" value="" checked>Allowed</label></td></tr>';

    });

    html +=   '</tbody></table></div><div style="width:100%"><a type="ap" id="'+uid+'" class="closepop a-tag">Save and Close</a></div>';


    if(typeof window.popovers[uid] === 'undefined') {
      window.popovers[uid] = html
    }

    $(document).find('#'+uid).on('shown.bs.popover', function () {

      let popid = $(this).attr('aria-describedby')

      let thisid = $(this).attr('id')

      $(document).find('#'+popid).first().find('.popover-content').first().html(window.popovers[thisid]);

    })

  }

  function addmaxstaypopHTML(uid){

    uid = 'maxstay-'+uid;

    html =  '<div class="table-responsive">'+
            '<table id="'+uid+'" class="table table-bordered"><tbody>';

    html += '<tr><td class="pop" style="font-weight: 900">Maximum Length of Stay (days)</td>'+
              '<td class="ttd pop"><input value="7" rid="'+uid+'" name="ip-rms" style="width:100px; height:100%;" placeholder="#"></td></tr>';

    html +=   '</tbody></table></div><div style="width:100%"><a id="'+uid+'" class="closepop a-tag">Save and Close</a></div>';


    if(typeof window.popovers[uid] === 'undefined') {
      window.popovers[uid] = html
    }

    $(document).find('#'+uid).on('shown.bs.popover', function () {

      let popid = $(this).attr('aria-describedby')

      let thisid = $(this).attr('id')

      $(document).find('#'+popid).first().find('.popover-content').first().html(window.popovers[thisid]);

    })

  }

  function addppopHTML(uid){

    uid = 'ppop-'+uid;

    let html = '<div class="table-responsive">'+
       '<table id="'+uid+'" class="table table-bordered"><tbody>';

    $.each(window.populationType, function( k1, value ) {

      html += '<tr><td class="pop" style="font-weight: 900">'+value+'</td>'+
              '<td class="ttd pop"><input value="0" name="ip-r" style="width:100px; height:100%;" placeholder="#"></td></tr>';

    });

    html +=   '</tbody></table></div><div style="width:100%"><a id="'+uid+'" class="closepop a-tag">Save and Close</a></div>';


    if(typeof window.popovers[uid] === 'undefined') {
      window.popovers[uid] = html
    }

    $(document).find('#'+uid).on('shown.bs.popover', function () {

      let popid = $(this).attr('aria-describedby')

      let thisid = $(this).attr('id')

      $(document).find('#'+popid).first().find('.popover-content').first().html(window.popovers[thisid]);

    })

  }

  function addcpopHTML(uid){

    uid = 'capop-'+uid;

    html =  '<div class="table-responsive">'+
            '<table id="'+uid+'" class="table table-bordered"><tbody>';

    html += '<tr><td class="pop" style="font-weight: 900">Population Count</td>'+
            '<td class="ttd pop" ><input id="pc-r-'+uid+'" name="pc-r" style="width:100px; height:100%;" placeholder="#" value="0"></td></tr>';

    html +=   '</tbody></table></div><div style="width:100%"><a id="'+uid+'" class="closepop a-tag">Save and Close</a></div>';


    if(typeof window.popovers[uid] === 'undefined') {
      window.popovers[uid] = html
    }

    $(document).find('#'+uid).on('shown.bs.popover', function () {

      let popid = $(this).attr('aria-describedby')

      let thisid = $(this).attr('id')

      $(document).find('#'+popid).first().find('.popover-content').first().html(window.popovers[thisid]);

    })

  }


  $(document).on("blur","input[name='ip-r']",function(e,data) {

    id = $(this).attr('rid')
    val = $(this).val()

    $(document).find('#iip-'+id).remove()

    html = '<input type="hidden" id="iip-'+id+'" val="'+val+'" class="caps">'

    $('body').append(html)

  });


  $(document).on("blur","input[name='pc-r']",function(e,data) {

    id = $(this).attr('id')
    val = $(this).val()

      $(document).find('#inp-'+id).remove()

      html = '<input type="hidden" id="inp-'+id+'" val="'+val+'" class="caps">'

      $('body').append(html)

  });

  $(document).on("change",".ana",function(e,data) {

    if ($(this).is(':checked')) {

      $(this).attr('checked','checked')

    } else {

      $(this).removeAttr('checked')

    }

  })

  $(document).on("change","#fileinput",function(e,data) {

      $(this).closest(".file").removeClass("bg-gradient-primary").addClass("bg-gradient-default").find('.txt').text($(this).val());

      //Reference the FileUpload element.
      var fileUpload = $("#fileinput")[0];

      //Validate whether File is valid Excel file.
      var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
      if (regex.test(fileUpload.value.toLowerCase())) {
          if (typeof (FileReader) != "undefined") {
              var reader = new FileReader();

              //For Browsers other than IE.
              if (reader.readAsBinaryString) {
                  reader.onload = function (e) {
                      ProcessExcel(e.target.result);
                  };
                  reader.readAsBinaryString(fileUpload.files[0]);
              } else {
                  //For IE Browser.
                  reader.onload = function (e) {
                      var data = "";
                      var bytes = new Uint8Array(e.target.result);
                      for (var i = 0; i < bytes.byteLength; i++) {
                          data += String.fromCharCode(bytes[i]);
                      }
                      ProcessExcel(data);
                  };
                  reader.readAsArrayBuffer(fileUpload.files[0]);
              }
          } else {
              alert("This browser does not support HTML5.");
          }
      } else {
          alert("Please upload a valid Excel file.");
      }

  });


  $(document).on("click",".deletesubresource",function() {

    $(this).closest(".subresource").remove();

  });

  $(document).on("click","#runsimulation",function() {

    $('#myform').submit()

  });

  //   $("body").on("click", "#upload", function () {
  //     //Reference the FileUpload element.
  //     var fileUpload = $("#fileinput")[0];

  //     //Validate whether File is valid Excel file.
  //     var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
  //     if (regex.test(fileUpload.value.toLowerCase())) {
  //         if (typeof (FileReader) != "undefined") {
  //             var reader = new FileReader();

  //             //For Browsers other than IE.
  //             if (reader.readAsBinaryString) {
  //                 reader.onload = function (e) {
  //                     ProcessExcel(e.target.result);
  //                 };
  //                 reader.readAsBinaryString(fileUpload.files[0]);
  //             } else {
  //                 //For IE Browser.
  //                 reader.onload = function (e) {
  //                     var data = "";
  //                     var bytes = new Uint8Array(e.target.result);
  //                     for (var i = 0; i < bytes.byteLength; i++) {
  //                         data += String.fromCharCode(bytes[i]);
  //                     }
  //                     ProcessExcel(data);
  //                 };
  //                 reader.readAsArrayBuffer(fileUpload.files[0]);
  //             }
  //         } else {
  //             alert("This browser does not support HTML5.");
  //         }
  //     } else {
  //         alert("Please upload a valid Excel file.");
  //     }
  // });



  function ProcessExcel(data) {

      var exceltojson = []

      //Read the Excel File data.
      var workbook = XLSX.read(data, {
          type: 'binary'
      });

      //Fetch the name of First Sheet.
      var firstSheet = workbook.SheetNames[0];

      //Read all rows from First Sheet into an JSON array.
      var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[firstSheet]);

      //Add the data rows from Excel file.
      for (var i = 0; i < excelRows.length; i++) {

        _rarray = []

        let _row = excelRows[i]

        let c = 0

        $.each(_row, function( index, value ) {

          if (c!=0) {
            _rarray.push(value)
          }
          c = c+1

        });

        exceltojson.push(_rarray)

      }

      let newarray = []

      for (var i = 0; i < exceltojson.length; i++) {

        for (var j = 0; j < exceltojson[i].length; j++) {

          newarray.push(exceltojson[i][j])

        }

      }

      $(document).find(".ttd").each(function (index, value) {
        
        $(this).find('input').val(newarray[index])

      });

  };


});