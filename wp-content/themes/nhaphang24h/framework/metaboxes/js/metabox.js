
jQuery(function($) {
	$('.ajax_tax_parent').change(function(){
		var that = $(this);
		var current_trigger = that.val();
		var tax = that.attr('data-tax');
		var target = that.attr('data-target');
		$('.'+target).html('');
		$.ajax({
            type: 'POST',
            url: jsdata.ajax_url,
            data: {"action": "custom_tax_select","tax":tax , "current" : 0 ,'current_trigger' : current_trigger  },
            beforeSend: function(){
				$('.'+target).html();
		 	},
		 	complete: function(){	
				
		 	},
            success: function(data){
				$('.'+target).html(data);
				//console.log(data);
            }
        });
        return false;
		
	});
	$('.ajax_tax').each(function(){
		var that = $(this);
		var tax = that.attr('data-tax');
		var trigger = that.attr('data-trigger');
		var current = that.attr('data-current');
		var current_trigger = $('#'+trigger).val();
		console.log(current_trigger);
		$.ajax({
            type: 'POST',
            url: jsdata.ajax_url,
            data: {"action": "custom_tax_select","tax":tax , "current" : current ,'current_trigger' : current_trigger  },
            beforeSend: function(){
				that.html('');
		 	},
		 	complete: function(){	
				
		 	},
            success: function(data){
				that.html(data);
				//console.log(data);
            }
        });
        return false;
	});
	//$('.ajax_tax').html('<option>1</option>');
	
});