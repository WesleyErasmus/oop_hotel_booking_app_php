<?php
// Hotel class
class Hotel
{
    protected $id;
    protected $name;
    protected $price_per_night;
    protected $thumbnail;
    protected $features;
    protected $type;
    protected $beds;
    protected $rating;
    protected $location;

    public function __construct($id, $name, $price_per_night, $thumbnail, $features, $type, $beds, $rating, $location)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price_per_night = $price_per_night;
        $this->thumbnail = $thumbnail;
        $this->features = $features;
        $this->type = $type;
        $this->beds = $beds;
        $this->rating = $rating;
        $this->location = $location;
    }

    public static function compareHotelPricing()
    {
        
        return '<span class="badge text-bg-success">Cheaper</span>';

    }

    public static function getRelatedHotels()
    {
        // Connect to database
        require_once "../data/DatabaseConnector.php";
        $conn = new DatabaseConnector();
        $conn = $conn->getConnection();

        $hotel = $_SESSION['hotel'];
        $type = $hotel['type'];

        $sql = "SELECT * FROM hotel WHERE type = '$type'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $related_hotels = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $related_hotels = null;
        }
        $conn->close();

        return $related_hotels;
    }
}

$related_hotels = Hotel::getRelatedHotels();
$_SESSION['relatedHotels'] = $related_hotels;
