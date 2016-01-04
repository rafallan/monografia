// Função que só admite letras
function somenteLetras(e){
	var tecla = (window.event)?event.keyCode:e.which;

	if((tecla >= 65 && tecla <=90) || (tecla>=97 && tecla<=122) || (tecla == 46)){
		return true;
	}
	else{
		if(tecla == 8 || tecla == 0 || tecla==32){ // 32 = Barra de espaço, 8 = delete
			return true;
		}
		else{
			return false;
		}
	}
}

// Torna todas as letras maiúsculas
function alteraMaiusculo(){
	var valor = document.getElementById("form").nome;
	var novoTexto = valor.value.toUpperCase();
	valor.value = novoTexto;
}