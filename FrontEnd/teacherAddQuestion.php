<html>

	<fieldset>
		<p> Write a function named <input type="text" name="newQues" id="newQues" size="20" placeholder="functionName">	
		that takes 
		<select name="argsAmount" id="argsAmount">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
		</select>
		arguments and <br><br>
		<input type="text" name="newExplenation" id="newExplenation" size="80" placeholder="Explanation of what to do i.e. get square of value"></textarea>
		<br><br>
		<b> Testcases</b>
		<br>
		<p>Seperate by spaces (if no arguements leave empty, use quotes if strings, leave empty if takes no arguments)</p>
		<label>

		<input type="text" name="testcase1" id="testcase1" size="10" 	placeholder="ie. 1;2">
		of type
		<select name="testcase1-inType" id="testcase1-inType">
			<option value="int">int</option>
			<option value="float">float</option>
			<option value="string">string</option>
			<option value="bool">bool</option>
		</select>
		and expect
		<input type="text" name="answer1" id="answer1" size="10" 	placeholder="ie. 3">
		of type
	<!-- 	<select name="testcase1-outType" id="testcase1-outType">
			<option value="int">int</option>
			<option value="float">float</option>
			<option value="string">string</option>
			<option value="bool">bool</option>
		</select> -->
		<br>

		<input type="text" name="testcase2" id="testcase2" size="10" 	placeholder="ie. 1;2">
		of type
		<select name="testcase2-inType" id="testcase2-inType">
			<option value="int">int</option>
			<option value="float">float</option>
			<option value="string">string</option>
			<option value="bool">bool</option>
		</select>
		and expect
		<input type="text" name="answer2" id="answer2" size="10" 	placeholder="ie. 3">
		of type
	<!-- 	<select name="testcase2-outType" id="testcase2-outType">
			<option value="int">int</option>
			<option value="float">float</option>
			<option value="string">string</option>
			<option value="bool">bool</option>
		</select> -->
		<br>


		<input type="text" name="testcase3" id="testcase3" size="10" 	placeholder="ie. 1;2">
		of type
		<select name="testcase3-inType" id="testcase3-inType">
			<option value="int">int</option>
			<option value="float">float</option>
			<option value="string">string</option>
			<option value="bool">bool</option>
		</select>
		and expect
		<input type="text" name="answer3" id="answer3" size="10" 	placeholder="ie. 3">
		of type
		<!-- <select name="testcase3-outType" id="testcase3-outType">
			<option value="int">int</option>
			<option value="float">float</option>
			<option value="string">string</option>
			<option value="bool">bool</option>
		</select> -->













		</p>
	<button type="button" onclick="sudmitQuestion();" id="button-newQuest">Add Question</button>
	</fieldset>
	

</html>