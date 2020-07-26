  
$(document).ready(function(){

  const general_Toast = Swal.mixin({
    toast: true,
    position: 'center',
    showConfirmButton: true,
    animation:true
  });


  $('.delete-simulation').on('click', function(e) {

      let sim_id = $(this).attr('sim_id')
      let elem = $(this)

      general_Toast.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {


          var token = $('input[name=_token]').attr('value');

          $.ajax({

              url: "/simulations/delete",
              type:"POST",
              data: { '_token': token,"sim_id": sim_id},

              success:function(data){

                if (data['status'] == 200) {

                  Swal.fire(
                    'Deleted!',
                    'Your simulation has been deleted.',
                    'success'
                  )

                  elem.parents('.jobs').first().remove()

                } else {

                  Swal.fire(
                    'Error',
                    'Something went wrong',
                    'error'
                  )

                }
                
              },error:function(e){

                Swal.fire(
                  'Error',
                  'Something went wrong',
                  'error'
                )

              }

          });

        }
      })


  })

  update()


})

function update(){

    let flag = false
    var el = $('.jobs').attr('id')
    var token = $('input[name=_token]').attr('value');

    $.ajax({

        url: "/simulations/progress-update",
        type:"POST",
        data: { '_token': token,"ids": ['?gkghfk5.423g44ths4.2y3yhey?.']},

        success:function(data){

          if (data['status']==200) {

            $.each(data['output'], function( index, value ) {

              let elem = $('.jobs[id='+index+']')

              elem.find('.statushtml').html(data['output'][index]['statushtml'])

              if (data['output'][index]['status'] != 1) {
                flag = true
              } else {
                let this_job = $('.jobs[id='+index+']')
                this_job.find('.result-btn').removeClass('disabled').attr('href','/simulations/view/'+index)
                setTimeout(function(){
                  this_job.find('.siminfo').first().remove();
                },3000)
             }

              let progress = parseFloat(data['output'][index]['progress']);
              progress =  progress.toFixed(2)

              if (progress==100.00) progress = 100

              elem.find('.progress-bar').first().css('width', progress+'%').attr('aria-valuenow',progress).html(progress+'%')

              elem.find('.simname').first().text(data['output'][index]['simulationname']);

            });

          }

          setTimeout(function(){
          
          if (flag) {
            update()
          }
          
          }, 500)

        },error:function(e){
          
          console.log('ee')

        }

    });
}