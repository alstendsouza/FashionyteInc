<div class="panel panel-default">
	<div class="panel-heading">
		Write a Review
	</div>
	<div class="panel-body">

		<form action="customer-review-create.php" class="form-horizontal" method="post" role="form" id="loginForm">
			<input class="form-control" id="new_review_item_id" name="review[item_id]" type="hidden" value="<?php echo $item_id; ?>">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="new_review_quality">Quality</label>
				<div class="col-sm-10">
					<input class="form-control" id="new_review_quality" name="review[quality]" type="number">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label" for="new_review_comments">Comments</label>
				<div class="col-sm-10">
					<textarea class="form-control" id="new_review_comments" name="review[comments]" rows="4"></textarea>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button class="btn btn-default" type="submit" />Submit</button>
				</div>
			</div>
		</form>
	</div>
</div>