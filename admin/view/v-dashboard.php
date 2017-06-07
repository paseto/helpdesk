<div id="layout-body" class="layout-padding form">
        <br />
        <div style="float:right; width:20%; text-align:right;"> <form>
        <label>View By:</label>
        <select id="dashboard-group-summary-date" name="dashboard-group-summary-date">
			<option value="today">Today</option>
			<option value="yesterday">Yesterday</option>
			<option value="this_week">This Week</option>
			<option value="last_week">Last Week</option>
			<option value="this_month">This Month</option>        
        </select>
        </form>
        </div>
        
        <div id="dashboardsum"></div>
		
        <h2><i class="fa fa-comments-o"></i> <?php echo $lang['dash-title-activity']; ?></h2>
        <hr>
        
        <div id="aa-recent-activity" class="recent-activity">
        <div id="load-image"></i></div>
        </div>	
        <div id="load-more"><?php echo $lang['dash-load-more']; ?></div>    

	
</div>