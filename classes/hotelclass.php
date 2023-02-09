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

    // Function is invoked if a related hotel is cheaper than the selected hotel
    public static function compareHotelPricing()
    {
        
        return '<span class="badge text-bg-success">Cheaper</span>';

    }

    // Displays related hotels based on the hotel type (e.g. suite, business, residential)
    public static function getRelatedHotels()
    {
        // Connect to database
        require_once "../data/DatabaseConnector.php";
        $conn = new DatabaseConnector();
        $conn = $conn->getConnection();

        // Storing session storage in variables
        $hotel = $_SESSION['hotel'];
        $type = $hotel['type'];

        // Querying hotel tables where the hotel type is the same as the selected hotel in the hotel view page
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
// Invoking gerRelatedHotels 
$related_hotels = Hotel::getRelatedHotels();
$_SESSION['relatedHotels'] = $related_hotels;
