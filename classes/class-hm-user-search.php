<?php

/**
 * Class HM_User_Search
 */
final class HM_User_Search {

	/**
	 * @var HM_User_Search The instance of this class.
	 */
	private static $_instance;

	/**
	 * Make sure we always return the same instance of this singleton class.
	 *
	 * @return HM_User_Search
	 */
	public static function get_instance() {

		if ( ! ( self::$_instance instanceof HM_User_Search ) ) {
			self::$_instance = new HM_User_Search();
		}

		return self::$_instance;
	}

	/**
	 * Hook into WordPress.
	 */
	private function __construct() {

		add_action( 'pre_get_users', array( $this, 'search_user_meta' ) );

		add_action( 'get_meta_sql', array( $this, 'get_meta_sql' ), 10, 6 );

	}

	/**
	 * Prevent object cloning.
	 */
	private function __clone() {
	}

	/**
	 * Search user meta fields as well, by adding meta queries.
	 *
	 * @param $user_query_instance
	 *
	 * @return mixed
	 */
	public function search_user_meta( $user_query_instance ) {

		if ( empty( $_REQUEST['s'] ) ) {
			return $user_query_instance;
		}

		$search_term = sanitize_text_field( $_REQUEST['s'] );

		// Add a custom query_var for checking purposes.
		$user_query_instance->query_vars['hm_user_search'] = true;

		$user_query_instance->query_vars['meta_query'] = array(
			'relation' => 'OR',
			array(
				'key'     => 'first_name',
				'value'   => $search_term,
				'compare' => 'LIKE'
			),
			array(
				'key'     => 'last_name',
				'value'   => $search_term,
				'compare' => 'LIKE'
			),
			array(
				'key'     => 'nickname',
				'value'   => $search_term,
				'compare' => 'LIKE'
			)
		);

		return $user_query_instance;

	}

	/**
	 * Modify the meta query SQL.
	 *
	 * @param $join_where
	 * @param $queries
	 * @param $type
	 * @param $primary_table
	 * @param $primary_id_column
	 * @param $context
	 *
	 * @return mixed
	 */
	public function get_meta_sql( $join_where, $queries, $type, $primary_table, $primary_id_column, $context ) {

		// Add a few checks to be extra safe.
		if ( ! ( $context instanceof WP_User_Query ) ) {
			return $join_where;
		}

		if ( ! $context->query_vars['hm_user_search'] ) {
			return $join_where;
		}

		if ( 'user' !== $type ) {
			return $join_where;
		}

		// Change the WHERE clause to use 'OR' instead of 'AND'
		$join_where['where'] = preg_replace( '/ AND (.*)/s', ' OR $1', $join_where['where'] );

		return $join_where;
	}

}
