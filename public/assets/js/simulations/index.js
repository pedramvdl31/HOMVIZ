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



$(document).ready(function(){
  // $('#statetransition_table').html('<p>In order to set the state transition, 2 or more states are required. Currently there are '+window.statelist.length+' state.</p>')

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
          transitionEffect:'fade'
       });

  $("#addresource").click(function(){

    count = $(document).find(".resources").length
    count = count + 1
    html = ' <div count="'+count+'" class="resources col-12 col-sm-6 col-md-4 d-flex align-items-stretch"><div class="card bg-light" style="width: 100%"><div class="card-header text-muted border-bottom-0"> Resource '+count+' &nbsp;&nbsp;&nbsp;<i class="fas fa-trash table-danger deleteresource" style="cursor: pointer;"></i></div><div class="card-body pt-0"> <div class="row"> <div class="col-12"><div class="form-group"><label for="inputName">Name</label><input name="resource['+count+'][name]" type="text" id="inputName" class="form-control"></div><div class="form-group"><label for="inputName">Capacity</label><input name="resource['+count+'][capacity]" type="text" id="inputName" class="form-control"></div><div class="form-group"><label for="inputName">Max Length (days) <small>optional</small></label><input name="resource['+count+'][maxlength]" type="text" id="inputName" class="form-control" value="NaN"></div><div class="row subresroucewrapper"></div></div></div></div><div class="card-footer"> <div class="text-right"> <a id="addsubresource" class="btn btn-sm btn-primary" style="color: white;cursor: pointer;"> <i class="fas fa-plus"></i> Add Sub-resource </a> </div></div></div></div>';
    $(html).insertBefore("#addresourcewrapper")

  });


  $(document).on("click","#addsubresource",function() {

    count = $(this).closest(".card").find('.subresource').length

    resCount = $(this).closest(".resources").attr("count")

    count = count + 1
    html = '<div class="col-6 col-sm-6 col-md-6 d-flex subresource"><div class="card bg-light"><div class="card-header text-muted border-bottom-0">Sub-Resource '+count+' &nbsp;&nbsp;&nbsp;<i class="fas fa-trash table-danger deletesubresource" style="cursor: pointer;"></i></div><div class="card-body pt-0"> <div class="row"> <div class="col-12"><div class="form-group"><label for="inputName">Name</label><input name="subresource['+resCount+']['+count+'][name]" type="text" id="inputName" class="form-control"></div><div class="form-group"><label for="inputName">Capacity</label><input name="subresource['+resCount+']['+count+'][capacity]" type="text" id="inputName" class="form-control"></div></div></div></div></div></div>';
    $(this).closest(".card").find('.subresroucewrapper').append(html)

  });


  $(".sw-btn-next").click(function(){

    // $('#statetransition_table').html('<p>In order to set the state transition, 2 or more states are required. Currently there are '+window.statelist.length+' state.</p>')

    if(window.statelist.length !== 0 && window.statelist.length !== 1){

      _exp = window.statelist

      _table = '<small>This table represents the probability of moving from one state to another. Absorbing states where the movement to other states is not allowed will have a probability of 0.</small><div class="table-responsive">'+
             '<table class="table table-bordered ">'+
              '<thead>'+
                '<tr>'+
                '<th>#</th>';

        $.each( _exp, function( key, value ) {
          _table += '<th>'+value+'</th>'
        });

        _table +=   '</tr>'+
            '</thead>'+
              '<tbody>';

        $.each( _exp, function( k1, value ) {

            _table +=   '<tr>'+
                  '<td style="font-weight: 900">'+value+'</td>';

            $.each( _exp, function( key, value ) {

              h = '<label class="radio-inline"><input value="isallowed" class="isallowed-radio transiteradio" type="radio" name="tranradio-'+k1+'-'+key+'">'+
                  '&nbsp;Allowed</label>&nbsp;&nbsp;&nbsp;&nbsp;<label class="radio-inline">'+
                  '<input class="notallowed-radio transiteradio" type="radio" name="tranradio-'+k1+'-'+key+'" value="notallowed">&nbsp;Not Allowed</label>';

              _table +=   '<td class="ttd">'+h+'</td>';

            });

          _table += '</tr>';

        });
        
        _table +=   '</tbody>'+
            '</table>'+
            '</div>';

      // $("#statetransition_table").html(_table)

    }

  })

  $(document).on("change",".transiteradio",function() {

    let value = $(this).val();
    let _class = "table-success";
    if (value=='notallowed') _class = "table-danger"
    $(this).closest("td").removeClass("table-success table-danger").addClass(_class)

  });

  $("#populationbtn").click(function(){

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
              '<td class="ttd"><input name="tablex" style="width:100px; height:100%;" value="0"></td></tr>';

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

  })

  $("#stateresourcebtn").click(function(){

    $('#stateresource_table').html("")

    _val = $("#stateresourcetext").val()
    _exp = _val.split(',')

    _table = '<small>This table represents the propreties of Resources and States. Resources take Allowed Population, Capacity, and Initial Population Count as an Input. States take Allowed Populationn, and Initial Populationn Count as an input.</small>'+
    '<br><small><strong>Allowed Population:</strong> The population type that is allowed to enter a resource. <strong>Capacity:</strong> Resource maximum capacity. <strong>Initial Population Count:</strong> The number of population in a resource at the begining of the simulation</small><div class="table-responsive">'+
           '<table class="table table-bordered ">'+
            '<thead>'+
              '<tr>'+
              '<th>Name</th><th>Resources / States</th><th>Type</th><th>Properties</th>';


    _table +=   '</tr>'+
      '</thead>'+
        '<tbody>';


    window.resstate = _exp

    $.each( _exp, function( k1, value ) {

      ht =   '<tr>'+
              '<td style="font-weight: 900" val="'+value+'" class="stname">'+value+'</td>'+
              '<td><label class="radio-inline"><input value="res" class="res-radio rsradio" type="radio" name="optradio-'+k1+'" rid="'+k1+'">&nbsp;Resource&nbsp;&nbsp;</label>'+
              '<label class="radio-inline"><input  rid="'+k1+'" class="rsradio" type="radio" name="optradio-'+k1+'" value="state">&nbsp;State</label></td>'+
              '<td><div class="form-group"><select class="form-control"><option id="Street">Street</option><option id="Shelter">Shelter</option>'+
              '<option id="HiddenHomeless">Hidden Homeless</option><option id="NotHomeless">Not Homeless</option><option id="TransitionalHousing">Transitional Housing</option>'+
              '<option id="Hospital">Hospital</option><option id="Rehabilitation">Rehabilitation</option></select></div></td>'+
              '<td class="ttd" id="td-'+k1+'"><a class="init-population a-tag popover-all" id="ip-'+k1+'" data-placement="bottom" data-toggle="popover">Initial Population</a>,&nbsp;&nbsp;'+
              '<a class="maxstay a-tag popover-all" id="ipms-'+k1+'" data-placement="bottom" data-toggle="popover">Maximum Length of Stay</a>,&nbsp;&nbsp;'+
              '<a class="ap-population a-tag popover-all" id="ap-'+k1+'" data-placement="bottom" data-toggle="popover">Allowed Population</a>,&nbsp;&nbsp;'+
              '<a class="t-pop a-tag popover-all" id="t-'+k1+'" data-placement="bottom" data-toggle="popover">Transition</a><span id="cs-'+k1+'">,&nbsp;&nbsp;'+
              '<a class="cap-population a-tag popover-all" data-placement="bottom" data-toggle="popover" id="c-'+k1+'">Capacity</a></span></td></tr>';

      _table += ht

    });

    _table +=   '</tbody></table></div>';

    $("#stateresource_table").append(_table)

    $('.t-pop').popover({html:true,title: "Transition"}).click(function(e) {
        $('.popover').not(this).hide();
        $(this).data("bs.popover").inState.click = false;
        $(this).popover('show');
        e.preventDefault();
    });

    $(document).find(".res-radio").prop("checked", true);

    $('.init-population').popover({html:true,title: "Initial Population"}).click(function(e) {
        $('.popover').not(this).hide();
        $(this).data("bs.popover").inState.click = false;
        $(this).popover('show');
        e.preventDefault();
    });

    $('.maxstay').popover({html:true,title: "Maximum Length of Stay"}).click(function(e) {
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

    $('.cap-population').popover({html:true,title: "Capacity"}).click(function(e) {
        $('.popover').not(this).hide();
        $(this).data("bs.popover").inState.click = false;
        $(this).popover('show');
        e.preventDefault();
    });

  })

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

  $(document).on("change",".rsradio",function(e,data) {

    id = $(this).attr('rid')

    val = $(this).parents('td').first().attr('val')

    if (this.value == 'res') {

      h = '<span id="cs-'+id+'">,&nbsp;&nbsp;'+
          '<a id="c-'+id+'" class="cap-population a-tag popover-all" data-placement="bottom" data-toggle="popover">Capacity</a></span>';

      $(document).find('#td-'+id).append(h)
          $('.cap-population').popover({html:true,title: "Capacity"}).click(function(e) {
          $('.popover').not(this).hide();
          $(this).data("bs.popover").inState.click = false;
          $(this).popover('show');
          e.preventDefault();
      });

      const index = window.statelist.indexOf(val);
      if (index > -1) {
        window.statelist.splice(index, 1);
      }

    } else if (this.value == 'state') {

      if (window.statelist.indexOf(val) === -1) {

        window.statelist.push(val)

      }

      $(document).find('#cs-'+id).remove()

    }

  })

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

        html += '<tr><td style="font-weight: 900">'+value+'</td>'+
                '<td class="ttd"><label class="checkbox-inline"><input class="ana" name="ap-po-'+k1+'" type="checkbox" value="" checked>Allowed</label></td></tr>';

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

  $(document).on("click",".t-pop",function(e,data) {

    id = $(this).attr('id');
    des = $(this).attr('aria-describedby');

    if($(document).find('.t-html[did="'+id+'"]').length == 0){

      html = '<div id="t-'+id+'" class="table-responsive">'+
         '<table id="'+id+'" class="table table-bordered">'+
            '<thead>'+
              '<tr>'+
                '<th>Resources and States</th><th>Transition Into</th>'+
              '</tr>'+
            '</thead>'+
            '<tbody>';


      name = $(this).parents('tr').first().find('.stname').first().attr('val')

      $.each( window.resstate, function( k1, value ) {

        if (name!=value) {

          html += '<tr><td style="font-weight: 900">'+value+'</td>'+
                '<td class="ttd"><label class="checkbox-inline"><input class="ana" name="t-po-'+k1+'" type="checkbox" value="" checked>Allowed</label></td></tr>';

        }

      });

      html +=   '</tbody></table></div><div style="width:100%"><a type="t" tid="'+id+'" id="'+des+'" class="closepop a-tag">Save and Close</a></div>';

      $('#'+id).on('shown.bs.popover', function () {
        $('#'+des).find('.popover-content').html(html);
      })

      $('body').append('<input type="hidden" class="'+id+'">')

    } else {

      html = $(document).find('.t-html[did="'+id+'"]').html()

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

    html = '<div class="table-responsive">'+
       '<table id="'+id+'" class="table table-bordered"><tbody>';

    html += '<tr><td style="font-weight: 900">Maximum Length of Stay (days)</td>'+
              '<td class="ttd"><input value="'+val+'" rid="'+id+'" name="ip-rms" style="width:100px; height:100%;" placeholder="#"></td></tr>';

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

    html += '<tr><td style="font-weight: 900">Initial Population</td>'+
              '<td class="ttd"><input value="'+val+'" rid="'+id+'" name="ip-r" style="width:100px; height:100%;" placeholder="#"></td></tr>';

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

    html = '<div class="table-responsive">'+
       '<table id="'+id+'" class="table table-bordered"><tbody>';

    html += '<tr><td style="font-weight: 900">Population Count</td>'+
              '<td class="ttd"><input id="pc-r-'+id+'" name="pc-r" style="width:100px; height:100%;" placeholder="#" value="'+val+'"></td></tr>';

    html +=   '</tbody></table></div><div style="width:100%"><a id="'+des+'" class="closepop a-tag">Save and Close</a></div>';

    $(document).find('#'+id).on('shown.bs.popover', function () {
      console.log("ccc")
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

    // Simulate a mouse click:
    // window.location.href = "/make-simulation";

    // // Simulate an HTTP redirect:
    // window.location.replace("/make-simulation");

  //   });

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
  });



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