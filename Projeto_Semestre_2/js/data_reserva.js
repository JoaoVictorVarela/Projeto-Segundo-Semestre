        // 1. Pega a data atual do sistema
        const hoje = new Date();
        
        // 2. Formata a data no padrão que o HTML exige: AAAA-MM-DD
        const ano = hoje.getFullYear();
        const mes = String(hoje.getMonth() + 1).padStart(2, '0'); // Meses começam em 0
        const dia = String(hoje.getDate()).padStart(2, '0');
        
        const dataFormatada = `${ano}-${mes}-${dia}`;
        
        // 3. Aplica o valor formatado ao atributo 'min' do input
        document.getElementById('data').min = dataFormatada;