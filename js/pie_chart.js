$(document).ready(function(){
    $.ajax({
        url:"mechanic_report_data.php",
        method:"GET",
        success:function(data){
            var ctx=document.getElementById("myChart").getContext("2d");
            var chart=new Chart(ctx,{
                type:"pie",
                data:{
                    labels:["Booked","Accepted","Rejected","Request For payment","Paid"],
                    datasets:[{
                        data:data,
                        backgroundColor:[colors(),colors(),colors(),colors(),colors()]
                    }]
                },
                options:{
                    title:{
                        display:true,
                        text:"Bookings",
                        fontSize:28,
                        fontColor:"rgba(0,0,0,1)"
                    },
                    legend:{
                        labels:{
                            fontSize:16,
                            fontColor:"rgba(0,0,0,1)" 
                        }
                    }
                }
            })
        },
        error:function(){
            alert("Unable to get the data")
        }
    })
})