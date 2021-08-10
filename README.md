# Teste UOL
---

Nesse repositório fica o código desenvolvido para o teste de nivelamento de skills

### Solicitado
---

- Elaborar um CRUD simples para as tabelas de matricula, curso, aluno
- Permitir ativar/desativar um aluno
- As migrations já estão criadas
- Testes unitário, PSR-12 contam pontos a mais
- Para o front fique a vontade entre usar Vue.js ou somente as blades do Laravel

### Como Configurar o Projeto
---

- Na raíz do projeto há um arquivo chamado `config.sh`, basta o executar que ele inicializa os containers do `Docker` para servir a aplicação.
- Por padrão o projeto está configurado para servir em `localhost:8000`.
- Para logar é preciso um `email` (`admin@mail.com`) e uma `senha` (`123`).

### Como Executar os Casos de Teste
---

- Na raíz do projeto há um arquivo chamado `run-unit-tests.sh`, ele executa todos os casos de teste desenvolvidos.
