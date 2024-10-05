
    <link rel="stylesheet" type="text/css" href="styles/filterStyle.css">


<?php
require_once 'includes/fetchForFilter.php';
?>

<div class="container">
    <div class="filter-container">
        <button class="filter-button">Filter</button>
        <div class="filter-options">
            <form id="filter-form" action="includes/filter-inc.php" method="post">
                <div class="filter-section">
                    <button type="button" class="toggle-button" data-target="genre-checkboxes">All Genres</button>
                    <div id="genre-checkboxes" class="checkbox-group hidden">
                        <?php foreach ($genres as $genre): ?>
                            <div class='checkbox-item'>
                                <input type='checkbox' name='genre[]' value="<?= htmlspecialchars($genre) ?>"> 
                                <label><?= htmlspecialchars($genre) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="filter-section">
                    <button type="button" class="toggle-button" data-target="director-checkboxes">All Directors</button>
                    <div id="director-checkboxes" class="checkbox-group hidden">
                        <?php foreach ($directors as $director): ?>
                            <div class='checkbox-item'>
                                <input type='checkbox' name='director[]' value="<?= htmlspecialchars($director) ?>"> 
                                <label><?= htmlspecialchars($director) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="filter-section">
                    <label for="date">Release Date:</label>
                    <input type="date" id="date" name="date">
                </div>
                <input type="hidden" name="selected_genres" id="selected-genres">
                <button type="submit" name="submit">Apply Filters</button>
            </form>
        </div>
    </div>
</div>

<script>

document.querySelectorAll('.toggle-button').forEach(function(button) {
    button.addEventListener('click', function() {
        const targetId = this.getAttribute('data-target');
        const targetElement = document.getElementById(targetId);

 
        if (targetElement.classList.contains('hidden')) {
            targetElement.classList.remove('hidden');
        } else {
            targetElement.classList.add('hidden');
        }
    });
});

document.getElementById('filter-form').addEventListener('submit', function (event) {
  //   event.preventDefault  აჩერებს ფეიჯის რელოადს ფორმის დასაბმითების შემდეგ
  // event.preventDefault();
    //  ცარიელი მასივი ჟანრის შესაგროვებლად
     let selectedGenres = [];
     
     // რომელი ჟანრიც მონიშნულია ვაგროვებთ selectedGenres  მასივში 
    //  input[name="genre[]"]:checked ვიღემთ მხოლოდ მონიშნულებს
    document.querySelectorAll('input[name="genre[]"]:checked').forEach(function (checkbox) {
        // forEach ით ვლუპავთ თითოეულ მონიშნულ ჩექს და push მეთოდის მეშვებოით ვინახავთ მასივში
        selectedGenres.push(checkbox.value);
     //   console.log(selectedGenres);
    });
        // ამ დამალულ ინფუთში ვინახავთ ჟანრებს join მეთოდი მასივს გადააქცევს სტრინგად და ერთმანეთს გამოყობს მძიმეთი 
        //  მაგალითად   ["საშინელებათა", "კომედია", "ფენტეზი"] = "საშინელებათა,კომედია,ფენტეზი";

     document.getElementById('selected-genres').value = selectedGenres.join(',');

     if(selectedGenres.length === 0) {
        event.preventDefault();
        console.log('empty array');
        alert('Please select at least one genre before applying filters.');
     } else {
        //  ვანხორცილებთ ფორმის დასაბმითებას რამაც ასევე უნდა დაათრიგეროს შენს მიერ გაწერილი php კოდიც
     this.submit(); 
     console.log(selectedGenres);
     }

});

//const btn = document.getElementById('filter-form');
//btn.addEventListener('click', function() {
//console.log('button was clicked');
//})
</script>


