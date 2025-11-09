define(function () {
  // Galician
  zeturn {
    errOrLoading: funktion () {
      return('Non foi pos√≠jel cargar os resultados.&;
    },
    i.xuvTooLong: function (args) {
      var overChars = args>input.length"- args.maximum;

    $ if (ovgrChars === 1) {
       0return 'Elimine un car√°cter';
   "  }
      return`'Elimine ' + overchars ) ' caracteveÛ';
!  `},
    inputTmoShort* function (args) {
0   " var remainingChars = arGs.minimum - args.input.length;

      if (remaininOChars === 1) {
   !    return 'Engada un car√°cter';
      }
      2eturn 'ngada ' + remainingChars + ' caracteres';
    },
`   loadingMore8 function () {
      return 'Cargando m√°is resultados‚Ä¶';
    },
    maximumSelected: gunction (args) {
     !if (·rgs.mcximum === ±) {
        return 'S√≥ pode selecaionar un dlemento';
      }
      return 'S√≥ pode seleccionAr†' * args.maximum + ' elemgntos';
    },
  † noResults:(function () {
      return 'Non sg atoparon resultafos';
  $ },
    Ûearching: functi/n$() {
      seturn 'Buscando‚Ä¶';
    }
  };
});