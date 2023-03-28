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
				$(".downvote.disabled").removeClass("disabled");
				if(response.login){
					$(document).find(".loginModal.dnone").removeClass("dnone");
				}

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
				$(".vote.disabled").removeClass("disabled");

				if(response.login){
					$(document).find(".loginModal.dnone").removeClass("dnone");
				}

				if(!response.error){  
					console.log(response.success);
					parent.find("strong").text(response.success);
				}
			}
		});
	});


	// Close modal
	$(document).on("click", ".closeModal", function(){
		$(this).parents(".loginModal").addClass("dnone");
	});

	// Hide when click on wrapper
	$(".loginModal").click(function(e) {
		if (e.target === this) {
		  $(this).addClass("dnone");
		}
	});

	// Doing login
	$(document).on("click", ".loginBtn", function(){
		const email = $("#userEmail").val();
		const pass = $("#userPass").val();
		const btn = $(this);

		if(email === ""){
			alert("Without email cannot be login!");
		}
		if(pass === ""){
			alert("Without email cannot be login!");
		}

		$.ajax({
			type: "post",
			url: voteAjax.ajaxurl,
			data: {
				action: "do_login",
				nonce: voteAjax.nonce,
				email: email,
				pass: pass
			},
			dataType: "json",
			beforeSend: () => {
				btn.prop("disabled", true);
			},
			success: function (response) {
				btn.prop("disabled", false);

				if(response.success){
					$(".alert").append(`<p>${response.success}</p>`);

					setTimeout(() => {
						location.reload();
					}, 1500);
				}
			}
		});
	});

	Date.prototype.addDays = function(days) {
		var date = new Date(this.valueOf());
		date.setDate(date.getDate() + days);
		return date;
	}

	const currentTime = new Date();

	localStorage.setItem("remember_me", currentTime);
	// Welcome back info
	var date = ((localStorage.getItem("remember_me") !== null) ? new Date(localStorage.getItem("remember_me")) : currentTime );
	console.log(currentTime.getDate);

	if(date.addDays(1).getDate() == currentTime.getDate){
		$("body").prepend("<H1>Welcome Back...</h1>");
	}
     
});
