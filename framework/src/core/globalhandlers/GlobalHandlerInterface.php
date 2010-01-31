<?php
interface GlobalHandlerInterface{
	/**
	 * This function stores values to the session
	 *
	 * @param mixed $index
	 * The index of an array where you would store the value.
	 *
	 * @param mixed $value
	 * The value you would to store to the given index.
	 *
	 * @return none
	 */
	public function setValue($index,$value);

	/**
	 * This function provides values stored in the session. If there is not
	 * such an index it gives back null;
	 *
	 * @param mixed $index
	 * @param mixed $value
	 * @return mixed
	 */
	public function getValue($index);

}