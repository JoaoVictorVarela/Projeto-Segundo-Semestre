const campos = document.querySelectorAll('.quantidade');
    const totalElemento = document.getElementById('total');

    function formatar(valor) {
        return valor.toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function calcularTotal() {
        let total = 0;

        campos.forEach(function(campo) {
            let quantidade = Number(campo.value);

            if (!Number.isInteger(quantidade) ||
                quantidade < 0 || quantidade > 99) {
                quantidade = 0;
            }

            const preco = Number(campo.dataset.preco);
            const subtotal = preco * quantidade;

            campo.closest('.prato')
                .querySelector('.valor-subtotal')
                .textContent = formatar(subtotal);

            total += subtotal;
        });

        totalElemento.textContent = formatar(total);
    }

    campos.forEach(function(campo) {
        campo.addEventListener('input', calcularTotal);
        campo.addEventListener('change', calcularTotal);
    });

    document.getElementById('formPedido')
        .addEventListener('submit', function(event) {
            const temItem = Array.from(campos).some(function(campo) {
                return Number(campo.value) > 0 &&
                    Number(campo.value) <= 99 &&
                    Number.isInteger(Number(campo.value));
            });

            if (!temItem) {
                event.preventDefault();
                alert('Selecione pelo menos um prato.');
                return;
            }

            if (!this.reportValidity()) {
                event.preventDefault();
                return;
            }

            if (!confirm(
                'Deseja confirmar o pedido no valor de R$ ' +
                totalElemento.textContent + '?'
            )) {
                event.preventDefault();
            }
        });

    calcularTotal();