<div class="list-group mt-4">
	<a href="friend-list.php" class="list-group-item list-group-item-action list-group-item-dark text-center">
		เพื่อน
	</a>
	<a href="friend-not.php" class="list-group-item list-group-item-action list-group-item-dark text-center">
		ยังไม่ได้เพิ่มเป็นเพื่อน
	</a>
	<a href="friend-re.php" class="list-group-item list-group-item-action list-group-item-dark text-center">
		ยังไม่ได้ตอบรับเป็นเพื่อน
	</a>
</div>
<script>
function update_user_activity()
{
 $.ajax({
  url:"action.php",
  method:"POST",
  data: {},
  success:function(data)
  {
	// console.log(data);
  }
 });
}
setInterval(function(){ 
 update_user_activity();
}, 10000);
</script>