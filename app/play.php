<?php /** @noinspection ForgottenDebugOutputInspection */
?>
<style>
    div { padding: 10px 0; }
    pre {
        border: 1px solid #ddd;
        background-color: #eee;
    }
</style>
<form method="post">

    <button type="submit">Submit</button>

    <div>
        <div>
            This demonstrates what happens when a value is sent twice (<i>lastWins</i>):
            <pre><?php print_r($_POST['lastWins'] ?? null) ?></pre>
        </div>
        <label>
            <input name="lastWins" value="a">
        </label>
        <label>
            <input name="lastWins" value="b">
        </label>
    </div>

    <div>
        <div>
            This demonstrates what happens when a simple value is sent first (<i>simpleThenArrayAppend</i>)
            followed by an array append (<i>simpleThenArrayAppend[]</i>): <b>We get an array with one entry. Last one wins again</b>
            <pre><?php print_r($_POST['simpleThenArrayAppend'] ?? null) ?></pre>
        </div>
        <label>
            <input name="simpleThenArrayAppend" value="a">
        </label>
        <label>
            <input name="simpleThenArrayAppend[]" value="b">
        </label>
    </div>

    <div>
        <div>
            This demonstrates what happens when an array append sent first (<i>arrayAppendThenSimple[]</i>)
            followed by a simple value (<i>arrayAppendThenSimple</i>): <b>Last one wins again. We get the simple value.</b>
            <pre><?php print_r($_POST['arrayAppendThenSimple'] ?? null) ?></pre>
        </div>
        <label>
            <input name="arrayAppendThenSimple[]" value="a">
        </label>
        <label>
            <input name="arrayAppendThenSimple" value="b">
        </label>
    </div>

    <div>
        <div>
            This demonstrates what happens when an array append sent twice (<i>arrayAppend[]</i>): <b>We get an array with two entries</b>
            <pre><?php print_r($_POST['arrayAppend'] ?? null) ?></pre>
        </div>
        <label>
            <input name="arrayAppend[]" value="a">
        </label>
        <label>
            <input name="arrayAppend[]" value="b">
        </label>
    </div>


    <div>
        <div>
            <i>arrayAppendThenWithKey[]</i> plus <i>arrayAppendThenWithKey[key]</i>: <b>We get an array with two entries and keys 0, key</b>
            <pre><?php print_r($_POST['arrayAppendThenWithKey'] ?? null) ?></pre>
        </div>
        <label>
            <input name="arrayAppendThenWithKey[]" value="a">
        </label>
        <label>
            <input name="arrayAppendThenWithKey[key]" value="b">
        </label>
    </div>

    <div>
        <div>
            <i>arrayAppendThenWithKeyFirst[key]</i> plus <i>arrayAppendThenWithKeyFirst[]</i>: <b>We get an array with two entries and keys key, 1</b>
            <pre><?php print_r($_POST['arrayAppendThenWithKeyFirst'] ?? null) ?></pre>
        </div>
        <label>
            <input name="arrayAppendThenWithKeyFirst[key]" value="a">
        </label>
        <label>
            <input name="arrayAppendThenWithKeyFirst[]" value="b">
        </label>
    </div>

    <div>
        <div>
            <i>nestedArrayAppend[][]</i> plus <i>nestedArrayAppend[][]</i>: <b>We get 2d array with one child on second level each</b>
            <pre><?php print_r($_POST['nestedArrayAppend'] ?? null) ?></pre>
        </div>
        <label>
            <input name="nestedArrayAppend[][]" value="a">
        </label>
        <label>
            <input name="nestedArrayAppend[][]" value="b">
        </label>
    </div>

    <div>
        <div>
            <i>nestedArrayAppendWithKey[key][]</i> plus <i>nestedArrayAppendWithKey[key][]</i>: <b>We get 2d array with two children on second level</b>
            <pre><?php print_r($_POST['nestedArrayAppendWithKey'] ?? null) ?></pre>
        </div>
        <label>
            <input name="nestedArrayAppendWithKey[key][]" value="a">
        </label>
        <label>
            <input name="nestedArrayAppendWithKey[key][]" value="b">
        </label>
    </div>

    <div>
        <div>
            <i>bracketsOnly</i>: <b>We get nothing</b>
        </div>
        <label>
            <input name="[]" value="a">
        </label>
    </div>

    <div>
        <div>
            <i>brokenBracket[</i>: <b>We get brokenBracket_ => a</b>
            <pre><?php print_r($_POST['brokenBracket_'] ?? null) ?></pre>
        </div>
        <label>
            <input name="brokenBracket[" value="a">
        </label>
    </div>

    <div>
        <div>
            <i>brokenBracket]</i>: <b>We get brokenBracket] => a</b>
            <pre><?php print_r($_POST['brokenBracket]'] ?? null) ?></pre>
        </div>
        <label>
            <input name="brokenBracket]" value="a">
        </label>
    </div>

    <div>
        <div>
            <i>special chars</i>: <b>We get "$`@{} => ["a", "b"]</b>
            <pre><?php print_r($_POST['$`@'] ?? null) ?></pre>
        </div>
        <label>
            <input name="$`@[]" value="a">
        </label>
        <label>
            <input name="$`@[]" value="b">
        </label>
    </div>

    <div>
        <div>
            <i>chars after brackets</i>: <b>Every thing after the last brackets is ignored</b>
            <pre><?php print_r($_POST['charAfterBrackets'] ?? null) ?></pre>
        </div>
        <label>
            <input name="charAfterBrackets[]1" value="a">
        </label>
        <label>
            <input name="charAfterBrackets[]2" value="b">
        </label>
    </div>

    <div>
        <div>
            <i>chars between brackets</i>: <b>Every starting with the first invalid char is ignored</b>
            <pre><?php print_r($_POST['char'] ?? null) ?></pre>
        </div>
        <label>
            <input name="char[a]BetweenBrackets[]" value="a">
        </label>
        <label>
            <input name="char[b]BetweenBrackets[]" value="b">
        </label>
    </div>

    <div>
        <div>
            <i>bracket in brackets</i>: <b>Counts as a normal key</b>
            <pre><?php print_r($_POST['bracketInBrackets'] ?? null) ?></pre>
        </div>
        <label>
            <input name="bracketInBrackets[[]]" value="a">
        </label>
        <label>
            <input name="bracketInBrackets[[]]" value="b">
        </label>
    </div>

    <button type="submit">Submit</button>

</form>

<div>
    <pre><?php var_dump($_POST) ?></pre>
</div>
