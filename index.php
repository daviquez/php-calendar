<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="calendar.css">
</head>
<body>
    
    <?php 
        class Calendar 
        {
            public $date;
            public $time;
            public $year;
            public $month;
            public $start_day;
            public $last_day;
            public $total_week;

            public function __construct($date)
            {
                $this->date = date_create($date);
                $this->time = strtotime($date);
                $this->year = date('Y', $this->time);
                $this->month = date('m', $this->time);
                $this->start_day = date('w', $this->time);
                $this->last_day = date('t', $this->time);
                $this->total_week = ceil(($this->start_day + $this->last_day) / 7);
            }

            /* PREV month*/
            public function getPrevMonth()
            {
                return date_format(date_sub($this->date, date_interval_create_from_date_string('1 months')), 'Y-m');
            }

            /* NEXT month*/
            public function getNextMonth()
            {
                return date_format(date_add($this->date, date_interval_create_from_date_string('2 months')), 'Y-m');
            }

            /* ACTUAL month*/
            public function getMonthEn()
            {
                $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                return $months[(int)$this->month - 1];
            }

            /* DAYS */
            public function getTable()
            {
                for ($i = 0; $i < $this->total_week; $i++) {
                    // week div opened
                    echo "<div class='fc-row'>";
                        // 7 columns grid per row
                        for ($j = 1; $j <= 7; $j++) {
                            // Set start day
                            $day = $i * 7 + $j - $this->start_day;

                            // div opened
                            // If today equals to databease date
                            if (date('Ymd') == $this->year . $this->month . $day) {
                                echo "<div class='fc-today'>";
                            } else {
                                echo "<div>";
                            }

                            // Get the number of days and print them inside the div above
                            if ($day > 0 && $day <= $this->last_day) {
                                echo "<span class='fc-date'>{$day}</span>";
                            }

                            // day div closed
                            echo "</div>";
                        }
                    // week div closed
                    echo "</div>";
                }
            }
        }

        $date = isset($_GET['date']) ? $_GET['date'] : date('Y-m');

        $calendar = new Calendar($date);
    ?>

    <div class="custom-calendar-wrap">
        <div class="custom-inner">
            <div class="custom-header clearfix">
                <nav>
                    <a href="?date=<?=$calendar->getPrevMonth()?>" class="custom-btn custom-prev"></a>
                    <div>
                        <h2 id="custom-month" class="custom-month"><?=$calendar->getMonthEn()?></h2>
                        <h3 id="custom-year" class="custom-year"><?=$calendar->year?></h3>
                    </div>
                    <a href="?date=<?=$calendar->getNextMonth()?>" class="custom-btn custom-next"></a>
                </nav>
            </div>
            <div id="calendar" class="fc-calendar-container">
                <div class="fc-calendar fc-five-rows">
                    <div class="fc-head">
                        <div>Sun</div>
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                    </div>
                    <div class="fc-body">
                        <?php $calendar->getTable(); ?>
                        <!-- <div class="fc-row">
                            <div><span class="fc-date"></span></div>
                            <div><span class="fc-date"></span></div>
                            <div><span class="fc-date"></span></div>
                            <div><span class="fc-date"></span></div>
                            <div><span class="fc-date"></span></div>
                            <div><span class="fc-date">1</span></div>
                            <div><span class="fc-date">2</span></div>
                        </div>
                        <div class="fc-row">
                            <div><span class="fc-date">3</span></div>
                            <div><span class="fc-date">4</span></div>
                            <div><span class="fc-date">5</span></div>
                            <div><span class="fc-date">6</span></div>
                            <div><span class="fc-date">7</span></div>
                            <div><span class="fc-date">8</span></div>
                            <div><span class="fc-date">9</span></div>
                        </div>
                        <div class="fc-row">
                            <div><span class="fc-date">10</span></div>
                            <div><span class="fc-date">11</span></div>
                            <div><span class="fc-date">12</span></div>
                            <div><span class="fc-date">13</span></div>
                            <div><span class="fc-date">14</span></div>
                            <div><span class="fc-date">15</span></div>
                            <div><span class="fc-date">16</span></div>
                        </div>
                        <div class="fc-row">
                            <div><span class="fc-date">17</span></div>
                            <div><span class="fc-date">18</span></div>
                            <div><span class="fc-date">19</span></div>
                            <div><span class="fc-date">20</span></div>
                            <div><span class="fc-date">21</span></div>
                            <div><span class="fc-date">22</span></div>
                            <div><span class="fc-date">23</span></div>
                        </div>
                        <div class="fc-row">
                            <div><span class="fc-date">24</span></div>
                            <div class="fc-today"><span class="fc-date">25</span></div>
                            <div><span class="fc-date">26</span></div>
                            <div><span class="fc-date">27</span></div>
                            <div><span class="fc-date">28</span></div>
                            <div><span class="fc-date"></span></div>
                            <div><span class="fc-date"></span></div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>


</body>

</html>