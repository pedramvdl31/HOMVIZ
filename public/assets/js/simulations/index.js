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
window.tableFlag = 0

function checkLoc(){

  if (window.loc == 1) {

    $('#loc-overview').text('Set').addClass('text-success').removeClass('text-danger')

    $('#loc-div').removeClass('hide')

  } else {

    $('#loc-overview').text('Not Set').addClass('text-danger').removeClass('text-success')

    $('#loc-div').addClass('hide')

  }

}

function checkpopulation(){

  window.population = 1

  if (window.population == 1) {

    $('#population-overview').text('Set').addClass('text-success').removeClass('text-danger')

  } else {

    $('#population-overview').text('Not Set').addClass('text-danger').removeClass('text-success')

  }

}

function checkstateres(){

  window.stateres = 1

  if (window.stateres == 1) {

    $('#stateres-overview').text('Set').addClass('text-success').removeClass('text-danger')

  } else {

    $('#stateres-overview').text('Not Set').addClass('text-danger').removeClass('text-success')

  }

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

    }
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
  $('#stateresourcebtn').on('click', function(e) {

    var elem = document.getElementById("stateresselect");
    var id = elem.options[elem.selectedIndex].id;

    if (id != 'title'){

      let name = elem.options[elem.selectedIndex].value;

      let type = $('option[id='+id+']').attr('type')

      processStateRes(name,id,type)

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

  function processStateRes(name,id,type){

      window.resstate.push(name)

      checkstateres()
      if (window.tableFlag== 0) {
        window.tableFlag = 1
        $("#staterestable tbody tr").remove()
      }

      $("#stateresselect option[id='"+id+"']").remove();

      let c = $("#staterestable tbody tr").length

      let row =   '<tr class="mainrow" count="'+c+'" rowname='+id+'>'+
                  '<td style="font-weight: 900" val="'+name+'" class="stname">'+name+'</td>'+

                  '<td><input rid="'+id+'" type="text" class="form-control nameinput" name="stateresname" placeholder="Name (unique)" value="'+name+'"><small class="text-danger hide">* duplication name is not allowed</small></td>'+

                  '<td><label class="radio-inline"><input value="res" class="res-radio rsradio" type="radio" name="optradio-'+id+'" rid="'+id+'">&nbsp;Resource&nbsp;&nbsp;</label>'+
                  '<label class="radio-inline"><input  rid="'+id+'" class="rsradio" type="radio" name="optradio-'+id+'" value="state">&nbsp;State</label></td>'+

                  '<td class="ttd" id="td-'+id+'"><a class="init-population a-tag popover-all" id="ip-'+id+'" data-placement="bottom" data-toggle="popover">Initial Population</a>,&nbsp;&nbsp;'+
                  '<a class="ap-population a-tag popover-all" id="ap-'+id+'" data-placement="bottom" data-toggle="popover">Allowed Population</a>,&nbsp;&nbsp;'+
                  '<a class="t-pop a-tag popover-all" id="t-'+id+'" data-placement="bottom" data-toggle="popover">Transition</a><span id="cs-'+id+'">,&nbsp;&nbsp;'+
                  '<a class="cap-population a-tag popover-all" data-placement="bottom" data-toggle="popover" id="c-'+id+'">Capacity</a></span>'+
                  '<span id="ms-'+id+'">,&nbsp;&nbsp;<a class="maxstay a-tag popover-all" id="ipms-'+id+'" data-placement="bottom" data-toggle="popover">Maximum Length of Stay</a></span></td>'+
                  
                  '<td class="stname"><a class="divide a-tag">Divide to sub elements</a></td>'+

                  '</tr>';

      if (type=="state") {

          row =   '<tr class="mainrow" count="'+c+'" rowname='+id+'>'+

                  '<td style="font-weight: 900" val="'+name+'" class="stname">'+name+'</td>'+

                  '<td><input rid="'+id+'" type="text" class="form-control nameinput" name="stateresname" placeholder="Name (unique)" value="'+name+'"><small class="text-danger hide">* duplication name is not allowed</small></td>'+

                  '<td><label class="radio-inline"><input value="res" class="res-radio rsradio" type="radio" name="optradio-'+id+'" rid="'+id+'">&nbsp;Resource&nbsp;&nbsp;</label>'+
                  '<label class="radio-inline"><input rid="'+id+'" class="rsradio" type="radio" name="optradio-'+id+'" value="state">&nbsp;State</label></td>'+

                  '<td class="ttd" id="td-'+id+'"><a class="init-population a-tag popover-all" id="ip-'+id+'" data-placement="bottom" data-toggle="popover">Initial Population</a>,&nbsp;&nbsp;'+
                  '<a class="ap-population a-tag popover-all" id="ap-'+id+'" data-placement="bottom" data-toggle="popover">Allowed Population</a>,&nbsp;&nbsp;'+
                  '<a class="t-pop a-tag popover-all" id="t-'+id+'" data-placement="bottom" data-toggle="popover">Transition</a><span id="cs-'+id+'">'+
                  '</td>'+
                  
                  '<td class="stname"><a class="divide a-tag">Divide to sub elements</a></td>'+

                  '</tr>';

      }

      $("#staterestable tbody").append(row)

      $(document).find("input[name=optradio-"+id+"][value=state]").prop("checked", true);

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

        $(document).find("input[name=optradio-"+id+"][value=res]").prop("checked", true);

      }

      $('.t-pop').popover({html:true,title: "Transition"}).click(function(e) {
          $('.popover').not(this).hide();
          $(this).data("bs.popover").inState.click = false;
          $(this).popover('show');
          e.preventDefault();
      });


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



  }

  
  $(document).on("click",".divide",function(e,data) {

    let elem = $(this).parents('tr').first()
    let rowcount = elem.attr('count')
    let name = elem.find('td').eq(0).text();
    let id = $(document).find('tr').length
    let rowname = elem.attr('rowname')

    let c = ($(document).find('tr[parent='+rowcount+']').length)+1

    elem.addClass('hassub')

    let _class = ""

    if (c!=1) 
      _class = 'nthsub'

    let optionSelected = document.querySelector('input[name="optradio-'+rowname+'"]:checked').value;


    let prevRowPropCol = '<a class="t-pop a-tag popover-all" id="t-'+id+'" data-placement="bottom" data-toggle="popover">Transition</a><span id="cs-'+id+'">';


    elem.find('td').eq(3).html(prevRowPropCol);


    let h = '<tr parent="'+rowcount+'" class="sub '+_class+'" count="'+c+'">'+
            '<td style="font-weight: 900" val="'+name+'" class="stname">&nbsp;—— '+name+'(Sub-'+c+')</td>'+
            '<td><input rid="'+id+'" type="text" class="form-control nameinput" name="stateresname" placeholder="Name (unique)"><small class="text-danger hide">* duplication name is not allowed</small></td>'+
            '<td></td>'+
            '<td class="ttd" id="td-'+id+'">'+
            '<a class="init-population a-tag popover-all" id="ip-'+id+'" data-placement="bottom" data-toggle="popover">Initial Population</a>,&nbsp;&nbsp;'+
            '<a class="ap-population a-tag popover-all" id="ap-'+id+'" data-placement="bottom" data-toggle="popover">Allowed Population</a>,&nbsp;&nbsp;'+
            '<a class="cap-population a-tag popover-all" data-placement="bottom" data-toggle="popover" id="c-'+id+'">Capacity</a></span>'+
            '<span id="ms-'+id+'">,&nbsp;&nbsp;<a class="maxstay a-tag popover-all" id="ipms-'+id+'" data-placement="bottom" data-toggle="popover">Maximum Length of Stay</a></span></td>'+
            '<td></td>'+
            '</tr>';

    
    if (optionSelected == 'state') {

      h = '<tr parent="'+rowcount+'" class="sub '+_class+'" count="'+c+'">'+
                  '<td style="font-weight: 900" val="'+name+'" class="stname">&nbsp;—— '+name+'(Sub-'+c+')</td>'+
                  '<td><input rid="'+id+'" type="text" class="form-control nameinput" name="stateresname" placeholder="Name (unique)"><small class="text-danger hide">* duplication name is not allowed</small></td>'+
                  '<td></td>'+
                  '<td class="ttd" id="td-'+id+'">'+
                  '<a class="init-population a-tag popover-all" id="ip-'+id+'" data-placement="bottom" data-toggle="popover">Initial Population</a>,&nbsp;&nbsp;'+
                  '<a class="ap-population a-tag popover-all" id="ap-'+id+'" data-placement="bottom" data-toggle="popover">Allowed Population</a></td>'+
                  '<td></td>'+
                  '</tr>';
      
    }

    if (c==1) {

      $(h).insertAfter(elem);

    } else {

      elem = $(document).find('tr[parent='+rowcount+']').last()

      elem.addClass('nthsub')

      $(h).insertAfter(elem);

    }

    activatePopUpWindows(optionSelected,rowname)
    

  })


  function activatePopUpWindows(type,id){

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

        $(document).find("input[name=optradio-"+id+"][value=res]").prop("checked", true);

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


  $(document).on("change",".rsradio",function(e,data) {

    // let id = $(this).attr('rid')

    // let val = $(this).parents('td').first().attr('val')

    // let elem = $(this).parents('tr').first()
    // let parentClass = elem.hasClass('hassub')

    // let rowcount = elem.attr('count')
    // let name = elem.find('td').eq(0).text();
    // let id = $(document).find('tr').length
    // let rowname = elem.attr('rowname')


    // let h = '<td class="ttd" id="td-'+id+'">'+
    //         '<a class="init-population a-tag popover-all" id="ip-'+id+'" data-placement="bottom" data-toggle="popover">Initial Population</a>,&nbsp;&nbsp;'+
    //         '<a class="ap-population a-tag popover-all" id="ap-'+id+'" data-placement="bottom" data-toggle="popover">Allowed Population</a>,&nbsp;&nbsp;'+
    //         '<a class="cap-population a-tag popover-all" data-placement="bottom" data-toggle="popover" id="c-'+id+'">Capacity</a></span>'+
    //         '<span id="ms-'+id+'">,&nbsp;&nbsp;<a class="maxstay a-tag popover-all" id="ipms-'+id+'" data-placement="bottom" data-toggle="popover">Maximum Length of Stay</a></span></td>';


    // if (parentClass) {



    // } else {

    //   elem.find('td').eq(3).html(h);

    // }










    
    // if (optionSelected == 'state') {

    //   h = '<tr parent="'+rowcount+'" class="sub '+_class+'" count="'+c+'">'+
    //               '<td style="font-weight: 900" val="'+name+'" class="stname">&nbsp;—— '+name+'(Sub-'+c+')</td>'+
    //               '<td><input rid="'+id+'" type="text" class="form-control nameinput" name="stateresname" placeholder="Name (unique)"><small class="text-danger hide">* duplication name is not allowed</small></td>'+
    //               '<td></td>'+
    //               '<td class="ttd" id="td-'+id+'">'+
    //               '<a class="init-population a-tag popover-all" id="ip-'+id+'" data-placement="bottom" data-toggle="popover">Initial Population</a>,&nbsp;&nbsp;'+
    //               '<a class="ap-population a-tag popover-all" id="ap-'+id+'" data-placement="bottom" data-toggle="popover">Allowed Population</a></td>'+
    //               '<td></td>'+
    //               '</tr>';
      
    // }


  })

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

    html =  '<div id="t-'+id+'" class="table-responsive">'+
            '<table id="'+id+'" class="table table-bordered">'+
            '<thead>'+
            '<tr>'+
            '<th>Resources and States</th><th>Transition Into</th>'+
            '</tr>'+
            '</thead>'+
            '<tbody>';

    name = $(this).parents('tr').first().attr('rowname')

    $.each( window.resstate, function( k1, value ) {

      if (name!=value) {

        html += '<tr><td style="font-weight: 900">'+value+'</td>'+
              '<td class="ttd"><label class="checkbox-inline"><input class="ana" name="t-po-'+k1+'" type="checkbox" value="" checked>Allowed</label></td></tr>';

      }

    });

    html +=   '</tbody></table></div><div style="width:100%"><a type="t" tid="'+id+'" id="'+des+'" class="closepop a-tag">Save and Close</a></div>';


    if($(document).find('.t-html[did="'+id+'"]').length == 0){


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