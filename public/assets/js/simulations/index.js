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
window.statelist = []
window.resstate = []
window.loc = 0
window.population = 0
window.stateres = 0
window.params = 0
window.transprob = 0
window.currentstep = 0

function btnStatus(){

  if (window.loc == 1 && window.population == 1 && window.stateres == 1 && window.params == 1 && window.transprob == 1) {

    $('#runsimulation').removeAttr('disabled').removeClass('btn-default').addClass('btn-primary')

  } else {

    $('#runsimulation').attr('disabled',true).removeClass('btn-primary').addClass('btn-default')

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

function checkpopulation(){

  window.population = 1

  if (window.population == 1) {

    $('#population-overview').text('Set').addClass('text-success').removeClass('text-danger')


  } else {

    $('#population-overview').text('Not Set').addClass('text-danger').removeClass('text-success')

  }

  btnStatus()

}

function checkstateres(){

  if (window.stateres == 1) {

    $('#stateres-overview').text('Set').addClass('text-success').removeClass('text-danger')

  } else {

    $('#stateres-overview').text('Not Set').addClass('text-danger').removeClass('text-success')

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

      _table = '<small>This table represents the popolation count of each category.</small><div class="table-responsive">'+
             '<table class="table table-bordered ">'+
              '<thead>'+
                '<tr>'+
                '<th>Population Type</th><th>Population Count #</th>';

      _hdntable = '<div class="table-responsive" style="display: none">'+
         '<table id="statetable" class="table table-bordered ">'+
            '<thead>'+
            '<tr>'+
            '<th>Population Type</th><th>Population Count #</th>';


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
                '<td class="ttd"><input class="form-control" name="tablex" style="width:100px; height:100%;" value="0"></td></tr>';

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

function resetTransitionProbTable(){

  html = '<div class="table-responsive">'+
  '<table id="transprop" class="table table-bordered">'+
  '<thead>'+
  '<tr><th></th>';


  $.each( window.resstate, function( k1, value ) {

  html += '<th>'+value+'</th>';

  });

  html += '</tr>'+
  '</thead>'+
  '<tbody>';

  $.each( window.resstate, function( k1, v1 ) {

    html += '<tr><td class="titles">'+v1+'</td>';

    $.each( window.resstate, function( k1, v2 ) {

      html += '<td><input id="'+v1+'-'+v2+'" type="text" class="form-control" placeholder="0 to 1" value="0"></td>';

    });

    html += '</tr>';

  });


  html += '</tbody></table></div>';

  $('#transitiontable').html(html)

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

  $('#smartwizard').smartWizard('reset');

  $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {

    window.currentstep = stepNumber

    if (stepNumber==3 && window.stateres==1) {
      
      window.transprob = 1

      checktranprob()
    }
    if (stepNumber==4) {

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

        if (window.stateres == 1) {
          $('#smartwizard').smartWizard("next")
        } else {
          Toast.fire({
          type: 'error',
          title: 'Resources and States are not set.'
          })
        }


      break;
      case 3:

        if (window.transprob == 1) {
          $('#smartwizard').smartWizard("next")
        } else {
          Toast.fire({
          type: 'error',
          title: 'Transition Probabilities are not set.'
          })
        }

      break;
      case 4:


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

  // ONE OPTION IS SELECTED ADDED TO THE TABLE
  $('#stateresourcebtn').on('click', function(e) {

    var elem = document.getElementById("stateresselect");
    var id = elem.options[elem.selectedIndex].id;

    if (id != 'title'){

      let name = elem.options[elem.selectedIndex].value;

      let type = $('option[id='+id+']').attr('type')

      $("#stateresselect option[id='"+id+"']").remove();

      processStateRes(name,id,type)

    }

  })

  // FINE DUPLICATE
  $(document).on("keyup",".nameinput",function() {

    let elem = $(this)
    let v = $(this).val().toLowerCase();
    let i = $(this).attr('rid')

    let f = 0

    $(document).find(".nameinput").each(function (index, value) {

      let this_val = $(this).val().toLowerCase();

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

  function processStateRes(name,id,type){

    // PUSH TO ARRAY FOR LATER USE, ON OTHER STEPS, SO WE KNOW WHAT STEP WAS ADDED
    window.resstate.push(name)

    resetTransitionProbTable()

    if (window.stateres == 0) {
      window.stateres = 1
      $("#staterestable tbody tr").remove()
    }
    checkstateres()

    let allrowcount = $("#staterestable tbody tr").length

    let row =   '<tr rowtype="'+type+'" class="mainrow" rownum="'+allrowcount+'" rowname='+id+'>'+
                '<td style="font-weight: 900" val="'+name+'" class="stname">'+name+'</td>'+
                '<td><input rid="'+id+'" type="text" class="form-control nameinput" name="stateresname" placeholder="Name (unique)" value="'+name+'">'+
                '<small class="text-danger hide">* duplication name is not allowed</small></td>';

    row += '<td class="ttd" id="td-'+id+'">';

    if (type=="res") {

      row +=  '<a class="init-population a-tag popover-all" id="ip-'+id+'" data-placement="bottom" data-toggle="popover">Initial Population</a>,&nbsp;&nbsp;'+
              '<a class="ap-population a-tag popover-all" id="ap-'+id+'" data-placement="bottom" data-toggle="popover">Allowed Population</a>,&nbsp;&nbsp;'+
              '<a class="cap-population a-tag popover-all" data-placement="bottom" data-toggle="popover" id="c-'+id+'">Capacity</a>,&nbsp;&nbsp;'+
              '<a class="maxstay a-tag popover-all" id="ipms-'+id+'" data-placement="bottom" data-toggle="popover">Maximum Length of Stay</a>';
      
    } else {

      row +=  '<a class="init-population a-tag popover-all" id="ip-'+id+'" data-placement="bottom" data-toggle="popover">Initial Population</a>,&nbsp;&nbsp;'+
              '<a class="ap-population a-tag popover-all" id="ap-'+id+'" data-placement="bottom" data-toggle="popover">Allowed Population</a>';

    }

    row+= '</td>';


    row +=  '<td class="stname"><a class="divide a-tag">Add Sub-Element <i class="fa fa-plus" aria-hidden="true"></i></a></td>'+
            '</tr>';

    $("#staterestable tbody").append(row)


    $('.init-population').popover({html:true,title: "Initial Population"}).click(function(e) {
      $('.popover').not(this).hide();
      $(this).data("bs.popover").inState.click = false;
      $(this).popover('show');
      e.preventDefault();
    });

    $('.ap-population').popover({html:true,title: "Allowed Population"}).click(function(e) {
      $('.popover').not(this).hide();
      $(this).data("bs.popover").inState.click = false;
      $(this).popover('show');
      e.preventDefault();
    });

    if (type=="res") {

      $('.maxstay').popover({html:true,title: "Maximum Length of Stay"}).click(function(e) {
        $('.popover').not(this).hide();
        $(this).data("bs.popover").inState.click = false;
        $(this).popover('show');
        e.preventDefault();
      });

      $('.cap-population').popover({html:true,title: "Capacity"}).click(function(e) {
        $('.popover').not(this).hide();
        $(this).data("bs.popover").inState.click = false;
        $(this).popover('show');
        e.preventDefault();
      });

    }

  }

  $(document).on("click",".divide",function(e,data) {

    let elem = $(this).parents('tr').first()
    let rownum = elem.attr('rownum')
    let name = elem.find('td').eq(0).attr('val');
    let subelementNum = ($(document).find('tr[parent='+rownum+']').length)+1
    let rowtype = elem.attr('rowtype')

    elem.find('td').eq(2).html('');

    // this subelement id
    let id = subelementNum+'-'+rownum

    elem.addClass('hassub')

    let _class = ""
    if (subelementNum!=1) 
      _class = 'nthsub'


    let h = '<tr parent="'+rownum+'" class="sub '+_class+'" rownum="'+subelementNum+'">'+
    '<td style="font-weight: 900" val="'+name+'" class="stname">&nbsp;—— '+name+'(Sub-'+subelementNum+')</td>'+
    '<td><input rid="'+id+'" type="text" class="form-control nameinput" name="stateresname" placeholder="Name (unique)"><small class="text-danger hide">* duplication name is not allowed</small></td>'+
    '<td class="ttd" id="td-'+id+'">';

    if (rowtype=='res') {

      h +=  '<a class="init-population a-tag popover-all" id="ip-'+id+'" data-placement="bottom" data-toggle="popover">Initial Population</a>,&nbsp;&nbsp;'+
            '<a class="ap-population a-tag popover-all" id="ap-'+id+'" data-placement="bottom" data-toggle="popover">Allowed Population</a>,&nbsp;&nbsp;'+
            '<a class="cap-population a-tag popover-all" data-placement="bottom" data-toggle="popover" id="c-'+id+'">Capacity</a>,&nbsp;&nbsp;'+
            '<a class="maxstay a-tag popover-all" id="ipms-'+id+'" data-placement="bottom" data-toggle="popover">Maximum Length of Stay</a>';

    } else {

      h +=  '<a class="init-population a-tag popover-all" id="ip-'+id+'" data-placement="bottom" data-toggle="popover">Initial Population</a>,&nbsp;&nbsp;'+
            '<a class="ap-population a-tag popover-all" id="ap-'+id+'" data-placement="bottom" data-toggle="popover">Allowed Population</a>';

    }


    h += '</td>';
    h += '<td></td>';
    h += '</tr>';


    if (subelementNum==1) {

      $(h).insertAfter(elem);

    } else {

      elem = $(document).find('tr[parent='+rownum+']').last()

      elem.addClass('nthsub')

      $(h).insertAfter(elem);

    }

    activatePopUpWindows(rowtype)


  })

  function activatePopUpWindows(type){

    if (type=="res") {

      $(document).find('.maxstay').popover({html:true,title: "Maximum Length of Stay"}).click(function(e) {
        $('.popover').not(this).hide();
        $(this).data("bs.popover").inState.click = false;
        $(this).popover('show');
        e.preventDefault();
      });

      $(document).find('.cap-population').popover({html:true,title: "Capacity"}).click(function(e) {
        $('.popover').not(this).hide();
        $(this).data("bs.popover").inState.click = false;
        $(this).popover('show');
        e.preventDefault();
      });

    }

    $(document).find('.t-pop').popover({html:true,title: "Transition"}).click(function(e) {
      $('.popover').not(this).hide();
      $(this).data("bs.popover").inState.click = false;
      $(this).popover('show');
      e.preventDefault();
    });


    $(document).find('.init-population').popover({html:true,title: "Initial Population"}).click(function(e) {
      $('.popover').not(this).hide();
      $(this).data("bs.popover").inState.click = false;
      $(this).popover('show');
      e.preventDefault();
    });

    $(document).find('.ap-population').popover({html:true,title: "Allowed Population"}).click(function(e) {
      $('.popover').not(this).hide();
      $(this).data("bs.popover").inState.click = false;
      $(this).popover('show');
      e.preventDefault();
    });

  }

  // *****************
  // STATE AND RESOURCES End

  $(document).on("click",".closepop",function(e,data) {

    did = $(this).attr('tid')


    if ( $(this).attr('type') == 'ap' ){

      $(document).find('.ap-html[did="'+did+'"]').remove()

      html = $(this).parents('.popover-content').first().html()

      div = '<div style="display:none" class="ap-html" did='+did+' >'+html+'</div>'

      $('body').append(div)

    } else {

      $(document).find('.t-html[did="'+did+'"]').remove()

      html = $(this).parents('.popover-content').first().html()

      div = '<div style="display:none" class="t-html" did='+did+' >'+html+'</div>'

      $('body').append(div)

    }

    $('.popover-all').popover('hide');

  });

  $("#toexcel").click(function(){

    exportTableToExcel('statetable', 'data')

  });

  $("#adddataanchor").click(function(){

    $('#uploadwrapper').addClass("show").removeClass("hide");

  });

  $(document).on("click",".ap-population",function(e,data) {

    id = $(this).attr('id');
    des = $(this).attr('aria-describedby');

    if($(document).find('.ap-html[did="'+id+'"]').length == 0){

      html = '<div id="tip-'+id+'" class="table-responsive">'+
      '<table id="'+id+'" class="table table-bordered">'+
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

      html +=   '</tbody></table></div><div style="width:100%"><a type="ap" aid="'+id+'" id="'+des+'" class="closepop a-tag">Save and Close</a></div>';

      $('#'+id).on('shown.bs.popover', function () {
        $('#'+des).find('.popover-content').html(html);
      })

      $('body').append('<input type="hidden" class="'+id+'">')

    } else {

      html = $(document).find('.ap-html[did="'+id+'"]').html()

      $('#'+id).on('shown.bs.popover', function () {
        $('#'+des).find('.popover-content').html(html);
      })

    }

  })

  $(document).on("click",".maxstay",function(e,data) {

    id = $(this).attr('id');

    des = $(this).attr('aria-describedby');


    val = $('#iipms-'+id).attr('val')

    if(typeof val == 'undefined'){
      val = 7
    }

    html =  '<div class="table-responsive">'+
    '<table id="'+id+'" class="table table-bordered"><tbody>';

    html += '<tr><td class="pop" style="font-weight: 900">Maximum Length of Stay (days)</td>'+
    '<td class="ttd pop"><input value="'+val+'" rid="'+id+'" name="ip-rms" style="width:100px; height:100%;" placeholder="#"></td></tr>';

    html +=   '</tbody></table></div><div style="width:100%"><a id="'+des+'" class="closepop a-tag">Save and Close</a></div>';

    $('#'+id).on('shown.bs.popover', function () {
      $('#'+des).find('.popover-content').html(html);
    })

  })

  $(document).on("click",".init-population",function(e,data) {

    id = $(this).attr('id');

    des = $(this).attr('aria-describedby');


    val = $('#iip-'+id).attr('val')

    if(typeof val == 'undefined'){
      val = 0
    }

    html = '<div class="table-responsive">'+
    '<table id="'+id+'" class="table table-bordered"><tbody>';

    $.each(window.populationType, function( k1, value ) {

      html += '<tr><td class="pop" style="font-weight: 900">'+value+'</td>'+
      '<td class="ttd pop"><input value="'+val+'" rid="'+id+'" name="ip-r" style="width:100px; height:100%;" placeholder="#"></td></tr>';


    });  

    html +=   '</tbody></table></div><div style="width:100%"><a id="'+des+'" class="closepop a-tag">Save and Close</a></div>';

    $('#'+id).on('shown.bs.popover', function () {
      $('#'+des).find('.popover-content').html(html);
    })

  })

  $(document).on("click",".cap-population",function(e,data) {

    id = $(this).attr('id');

    des = $(this).attr('aria-describedby');

    val = $('#inp-pc-r-'+id).attr('val')

    if(typeof val == 'undefined'){
      val = 0
    }

    html =  '<div class="table-responsive">'+
    '<table id="'+id+'" class="table table-bordered"><tbody>';

    html += '<tr><td class="pop" style="font-weight: 900">Population Count</td>'+
    '<td class="ttd pop" ><input id="pc-r-'+id+'" name="pc-r" style="width:100px; height:100%;" placeholder="#" value="'+val+'"></td></tr>';

    html +=   '</tbody></table></div><div style="width:100%"><a id="'+des+'" class="closepop a-tag">Save and Close</a></div>';

    $(document).find('#'+id).on('shown.bs.popover', function () {
      $(document).find('.popover-content').html(html);
    })

  })

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

  $(document).on("click",".deleteresource",function() {

    $(this).closest(".resources").remove();

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