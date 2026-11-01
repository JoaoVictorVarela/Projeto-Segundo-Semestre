# Verificação de duas etapas do La Fome

Depois de validar e-mail e senha, o sistema escolhe aleatoriamente uma pergunta entre nome da mãe, data de nascimento e CEP. A resposta é comparada com o registro do usuário no banco `lafome`. A sessão autenticada só é criada quando as duas etapas são concluídas.

São permitidas três respostas incorretas. Na terceira, o estado pendente é apagado, a mensagem **“3 tentativas sem sucesso! Favor realizar login novamente.”** é exibida na tela de login e o usuário precisa começar novamente.

## Banco de dados

A tabela `usuarios` do arquivo `lafome.sql` já contém `nome_materno`, `data_nascimento` e `cep`; por isso, esta implementação não exige migração SQL. Importe o banco normalmente e confirme que esses campos estão preenchidos para cada conta.

## Arquivos adicionados/alterados

- `testeLogin.php`: valida a senha e inicia o desafio aleatório, sem autenticar ainda.
- `perguntas2fa.php`, `verificacao2fa.php` e `verifica2fa.php`: definem, exibem e validam o desafio.
- `login.php` e `css/login.css`: exibem mensagens e mantêm o estilo existente.
- `index.php`, `reserva.php`, `usuarios.php`, `deletar.php` e `sair.php`: reconhecem apenas sessões que completaram a etapa adicional; a área administrativa também exige perfil `admin`.

## Teste manual

1. Faça login com uma conta cadastrada.
2. Confirme que aparece exatamente uma das três perguntas e somente um campo de resposta.
3. Envie a resposta correta e confirme que o login é concluído.
4. Inicie outro login e envie respostas erradas três vezes; a terceira tentativa deve voltar à tela de login com a mensagem acima.
5. Tente abrir `usuarios.php` e `deletar.php` sem login concluído e confirme que o acesso é recusado.

> Observação: perguntas sobre dados pessoais são uma verificação de conhecimento, não um segundo fator forte como aplicativo autenticador ou chave física. Como os dados podem ser conhecidos ou adivinhados, use este mecanismo como requisito de demonstração/projeto acadêmico, não como MFA de produção.
