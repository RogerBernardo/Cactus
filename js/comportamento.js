function mudarCorForm() {
    var select = document.getElementById('select-cores').value;

    switch (select) {
        case 'rosa':
            document.getElementById('form-notas').style.backgroundColor = '#F294C0';
            break;

        case 'amarelo':
            document.getElementById('form-notas').style.backgroundColor = '#FFE52E';
            break;

        case 'azul':
            document.getElementById('form-notas').style.backgroundColor = '#6BDBFF';
            break;

        case 'verde':
            document.getElementById('form-notas').style.backgroundColor = '#52D981';
            break;

        case 'padrao':
            document.getElementById('form-notas').style.backgroundColor = '#FFFFFF';
            break;

        default:
            document.getElementById('form-notas').style.backgroundColor = '#FFFFFF';
            break;

    }
}