<?php
// Hotel class
class Hotel
{
    protected $id;
    protected $name;
    protected $pricepernight;
    protected $thumbnail;
    protected $features;
    protected $type;
    protected $beds;
    protected $rating;
    protected $location;

    public function __construct($id, $name, $pricepernight, $thumbnail, $features, $type, $beds, $rating, $location)
    {
        $this->id = $id;
        $this->name = $name;
        $this->pricepernight = $pricepernight;
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
            $relatedHotels = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $relatedHotels = null;
        }
        $conn->close();

        return $relatedHotels;
    }
}

$relatedHotels = Hotel::getRelatedHotels();
$_SESSION['relatedHotels'] = $relatedHotels;
