<?php
// templates/calendar.php
$currentMonth = date('F');
$currentYear = date('Y');
$daysInMonth = date('t');
$firstDayOfMonth = date('w', strtotime(date('Y-m-01')));
?>
<div class="calendar-widget">
    <div class="calendar-header">
        <button class="calendar-nav-btn">❮</button>
        <span class="calendar-title"><?php echo $currentMonth . ' ' . $currentYear; ?></span>
        <button class="calendar-nav-btn">❯</button>
    </div>
    
    <div class="calendar-grid">
        <div class="calendar-weekdays">
            <div class="weekday">S</div>
            <div class="weekday">M</div>
            <div class="weekday">T</div>
            <div class="weekday">W</div>
            <div class="weekday">T</div>
            <div class="weekday">F</div>
            <div class="weekday">S</div>
        </div>
        
        <div class="calendar-days">
            <?php
            // Empty cells for days before month starts
            for ($i = 0; $i < $firstDayOfMonth; $i++) {
                echo '<div class="calendar-day empty"></div>';
            }
            
            // Days of the month
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $isToday = ($day == date('j')) ? 'today' : '';
                $isSelected = ($day == 18 || $day == 26) ? 'selected' : '';
                echo '<div class="calendar-day ' . $isToday . ' ' . $isSelected . '">' . $day . '</div>';
            }
            ?>
        </div>
    </div>
    
    <div class="calendar-actions">
        <button class="calendar-btn cancel">Cancel</button>
        <button class="calendar-btn filter">Filter</button>
    </div>
</div>