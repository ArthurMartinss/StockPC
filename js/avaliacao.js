
  const stars = document.querySelectorAll('.star');
  const ratingContainer = document.querySelector('.rating');

  stars.forEach((star) => {
    star.addEventListener('click', () => {
      const starValue = star.getAttribute('data-star');
      ratingContainer.setAttribute('data-rating', starValue);

      // Atualize a aparência das estrelas
      stars.forEach((s) => {
        const sValue = s.getAttribute('data-star');
        if (sValue <= starValue) {
          s.innerHTML = '&#9733;'; // Estrela preenchida
        } else {
          s.innerHTML = '&#9734;'; // Estrela vazia
        }
      });
    });

    star.addEventListener('mouseover', () => {
      const starValue = star.getAttribute('data-star');
      stars.forEach((s) => {
        const sValue = s.getAttribute('data-star');
        if (sValue <= starValue) {
          s.style.color = '#ffab00'; // Cor das estrelas ao passar o mouse
        }
      });
    });

    star.addEventListener('mouseout', () => {
      stars.forEach((s) => {
        s.style.color = '#ffd700'; // Restaurar a cor original das estrelas
      });
    });
  });