<script>
function ms2Time(ms) {
    var secs = ms / 1000;
    ms = Math.floor(ms % 1000);
    var minutes = secs / 60;
    secs = Math.floor(secs % 60);
    var hours = minutes / 60;
    minutes = Math.floor(minutes % 60);
    hours = Math.floor(hours % 24);
    //return hours + ":" + minutes + ":" + secs + "." + ms;  
    return hours + ":" + minutes + ":" + secs;  
}
</script>
<script>
  $(document).ready(function() {
	var start = new Date();
	setInterval(function() {
		var end = new Date();
		var tournament_id = "<?php echo @$session_tournament_id; ?>"; //1=Home-Page  2=Practice-Genre  3=Practice-Game-Play  4=Tournament-Detail  5=Tournament-Game-Play  6=Tournament-Practice-Game-Play  7=User-Profile  8=Tournaments-History 
		var game_id = "<?php echo @$session_game_id; ?>"; //1=Home-Page  2=Practice-Genre  3= Practice-Game-Play  4=Tournament-Detail  5=Tournament-Game-Play  6=Tournament-Practice-Game-Play  7=User-Profile  8=Tournaments-History 
		var session_page = "<?php print_r($session_page_type); ?>"; //1=Home-Page  2=Live Tournament Info  3=Live Tournament Practice-Game-Play  4=Live-Tournament-Game-Play  5=Practice-Game-Play  6=User-Profile  7=Live-Tournament-Leader-Board  
		// 8=Spin and win 9=Tournament History   
		// 13 = View Private tournament details 14=Notifications 
		var curr_date = end.getDate();
		var curr_month = end.getMonth() + 1; //Months are zero based
		var curr_year = end.getFullYear();
		var sessionEndTime = (curr_year + "-" + curr_month + "-" + curr_date+ " " + end.getHours() +":" + end.getMinutes() + ":" + end.getSeconds());
		
		var timeSpent = (end - start);
		timeSpent = ms2Time(timeSpent);
		
		var dataStr = "session_page="+session_page+"&time="+ timeSpent+"&endTime="+sessionEndTime+"&game_id="+game_id+"&tournament_id="+tournament_id;
		//console.log(dataStr);
		$.ajax({
			crossDomain: true,
			url:"<?php echo site_url('site/captureTimeToLeave') ?>", 
			data: dataStr,
			type: "POST",
			async: false,
			success: function(response){
				// console.log("Time "+response);
				// alert(response);
			}
		});
	}, 5000);
  });

</script>