function makeMove(next, index) {
    const block = document.querySelectorAll("form .block")[index];
    const input = document.createElement("input");
    input.type = "text";
    input.value = next;
    input.name = `block-${index}`;
    block.appendChild(input);
    document.forms['game'].submit();
}

function restartGame() {
    window.location.replace(window.location.href.replace("/index.php", ""));
}