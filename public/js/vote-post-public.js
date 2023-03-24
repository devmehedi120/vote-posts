jQuery(function( $ ) {
	'use strict';

	// Vote
	$(document).on("click", ".vote", function(){
		const postId = $(this).parents(".voteModule").data("id");
		const parent = $(this).parents(".voteModule");
		const btn = $(this);

		$.ajax({
			type: "post",
			url: voteAjax.ajaxurl,
			data: {
				action: "vote_adding_process",
				postId: postId,
				nonce: voteAjax.nonce
			},
			beforeSend: ()=>{
				btn.addClass("disabled");
			},
			dataType: "json",
			success: function (response) {
				btn.removeClass("disabled");

				if(response.error){
					alert(response.error);
				}

				if(response.success){
					parent.find("strong").text(response.success);
				}
			}
		});
	});

	// Downvote
	$(document).on("click", ".downvote", function(){
		const postId = $(this).parents(".voteModule").data("id");
		const parent = $(this).parents(".voteModule");
		const btn = $(this);

		$.ajax({
			type: "post",
			url: voteAjax.ajaxurl,
			data: {
				action: "downvote_adding_process",
				postId: postId,
				nonce: voteAjax.nonce
			},
			beforeSend: ()=>{
				btn.addClass("disabled");
			},
			dataType: "json",
			success: function (response) {
				btn.removeClass("disabled");

				if(!response.error){
					console.log(response.success);
					parent.find("strong").text(response.success);
				}
			}
		});
	});

});
