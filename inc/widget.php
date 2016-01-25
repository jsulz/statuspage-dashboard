<?php

add_action( 'widgets_init', 'register_unique_widget_name' );

//register widget
function register_unique_widget_name() {
	register_widget( 'unique_widget_name' );
}

//Unique Widget Name Class
class Unique_Widget_Name extends WP_Widget {

	//Set up widget class name and description
	function __construct() {
		
		parent::__construct(
			__CLASS__,
			__('Unique Widget Title' , 'text_domain'),
			array ('description' 	=> __('This is a bit of text about my unique widget' , 'text_domain'), )
		);
	}

	//build the form
	function form(  ) {

		//first set up the default values in case  doesn't have all of them
		 = array();
		 = wp_parse_args( ( array ) ,  );

		//next set the values from the instance object to be unique variables so that they can be used in the form
		//here's an example of how to do this for the title

		//first set up a blank value for the variables that our defaults don't catch
		 = '';
		//next, check to see if those values are actually set in 
		if ( isset( ['title'] ) ) {
			//if  has a value for that key, then set the blank variable to equal that value!
			 = ['title'];
		}

		//then use that variable in the form
		?>

			<p>Title: 
				<input class='widefat' name="<?php echo ->get_field_name( 'title' ); ?>" type='text' value="<?php echo esc_attr(  ); ?>" />
			</p>

		<?php
	}

	//save the widget settings
	function update( ,  ) {

		//set the  object equal to an array
		 = array();
		//set up the  by checking the value of the new_instance to make sure the values passed in the form 
		['title'] = ( ! empty( ['title'] ) ) ? strip_tags( ['title'] ) : '';

		return ;

	}

	//output the widget
	function widget( ,  ) {

		//this gives us access to some default arguments that we can use to display standard WordPress information like  
		extract();

		echo ;
		//output all of the information
		 = apply_filters( 'widget_title', ['title'] );

		echo  .  . ;



	}

}

?>