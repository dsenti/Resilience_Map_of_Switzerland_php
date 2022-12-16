<script>
    function get_indexes() {
        //the same indexing which is used by the map
        var raw_indexes = <?php include('data/indexes_districts.php'); ?>

        return JSON.parse(raw_indexes);
    }
    //function which returns name of feature
    function get_name(feature) {
        let indexes = get_indexes();
        let full_name = indexes["District"][Number(feature.id)]
        return full_name.slice(3, full_name.length);
    }

    //   =======================================================================================================
    function get_average_farm_size_data() {
        //the json files which were generated in create_data
        var raw_data = <?php include("data/data_districts_average_farm_size.php"); ?>;
        return JSON.parse(raw_data);
    }

    function get_farm_size_max() {
        return 52.5;
    }

    function get_average_farm_size(feature) {

        //getting the data
        var data = get_average_farm_size_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon)
        id = Number(feature.id);

        //getting the district name with the id
        district = indexes["District"][id];
        //getting the district average farm size (value) with the district name
        value = Number(data["2021 average farm size"][district]);
        value = (Math.round(value * 10) / 10)
        return value;
    }

    function get_number_of_farms(feature) {

        //getting the data
        var data = get_average_farm_size_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon)
        id = Number(feature.id);

        //getting the district name with the id
        district = indexes["District"][id];
        //getting the district number of farms (value) with the district name
        value = Number(data["2021 number of farms"][district]);
        value = (Math.round(value * 100) / 100)
        return value;
    }

    function get_total_farm_area(feature) {

        //getting the data
        var data = get_average_farm_size_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon)
        id = Number(feature.id);

        //getting the district name with the id
        district = indexes["District"][id];
        //getting the district number of farms (value) with the district name
        value = Number(data["2021 total farm area"][district]);
        value = (Math.round(value * 100) / 100)
        return value;
    }

    // soil artificialization ==============================================================================================================================
    function get_soil_artificialization_data() {
        //the json files which were generated in create_data
        var raw_data = <?php include("data/data_districts_artificialization.php"); ?>;
        return JSON.parse(raw_data);
    }

    function get_soil_artificialization_max() {
        return 3.19;
    }

    function get_soil_artificialization(feature) {

        //getting the data
        var data = get_soil_artificialization_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon)
        id = Number(feature.id);

        //getting the district name with the id
        district = indexes["District"][id];
        //getting the district average farm size (value) with the district name
        value = Number(data["increase in artificial land"][district]);
        value = (Math.round(value * 100) / 100)

        return value;
    }

    function get_area(feature) {

        //getting the data
        var data = get_soil_artificialization_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon)
        id = Number(feature.id);

        //getting the district name with the id
        district = indexes["District"][id];
        //getting the value with the district name
        value = Number(data["Fläche - Total 2013/18"][district]);
        value = (Math.round(value * 100) / 100)

        return value;
    }

    function get_artificial2018(feature) {

        //getting the data
        var data = get_soil_artificialization_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon)
        id = Number(feature.id);

        //getting the district name with the id
        district = indexes["District"][id];
        //getting the value with the district name
        value = Number(data["-10 Künstlich angelegte Flächen 2013/18"][district]);
        value = (Math.round(value * 100) / 100)

        return value;
    }

    function get_artificial2009(feature) {

        //getting the data
        var data = get_soil_artificialization_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon)
        id = Number(feature.id);

        //getting the district name with the id
        district = indexes["District"][id];
        //getting the value with the district name
        value = Number(data["-10 Künstlich angelegte Flächen 2004/09"][district]);
        value = (Math.round(value * 100) / 100)

        return value;
    }

    // impermeability ==============================================================================================================================

    function get_impermeability_data() {
        //the json files which were generated in create_data
        var raw_data = <?php include("data/data_districts_impermeability.php"); ?>;
        return JSON.parse(raw_data);
    }

    function get_impermeability_percentage_max() {
        return 49.5;
    }

    function get_impermeability_percentage(feature) {

        //getting the data
        var data = get_impermeability_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon)
        id = Number(feature.id);

        //getting the district name with the id
        district = indexes["District"][id];
        //getting the district average farm size (dafs) with the district name
        value = Number(data["percentage artificially impermeable"][district]);
        value = (Math.round(value * 100) / 100)

        return value;
    }

    function get_impermeable(feature) {

        //getting the data
        var data = get_impermeability_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon)
        id = Number(feature.id);

        //getting the district name with the id
        district = indexes["District"][id];
        //getting the district average farm size (dafs) with the district name
        value = Number(data[">>10.11 Befestigte Flächen 2013/18"][district]) + Number(data[">>10.12 Gebäude 2013/18"][district]) + Number(data[">>10.13 Treibhäuser 2013/18"][district]) + Number(data[">>10.17 Gemischte Kleinstrukturen 2013/18"][district]);
        value = (Math.round(value * 100) / 100);

        return value;
    }

    //organic farming ================================================================================================================

    function get_organic_farming_data() {
        //the json files which were generated in create_data
        var raw_data = <?php include("data/data_districts_organic_farming.php"); ?>;
        return JSON.parse(raw_data);
    }

    function get_organic_farming_percentage_max() {
        return 83.6;
    }

    function get_organic_farming_percentage(feature) {

        //getting the data
        var data = get_organic_farming_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon)
        id = Number(feature.id);

        //getting the district name with the id
        district = indexes["District"][id];
        //getting the district average farm size (dafs) with the district name
        value = Number(data["percentage biological farmland"][district]);
        value = (Math.round(value * 100) / 100)

        return value;
    }

    function get_organic_farming_total_area(feature) {

        //getting the data
        var data = get_organic_farming_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon)
        id = Number(feature.id);

        //getting the district name with the id
        district = indexes["District"][id];
        //getting the district average farm size (dafs) with the district name
        value = Number(data["Biologische Betriebe"][district]);
        value = (Math.round(value * 100) / 100)

        return value;
    }

    //farmers ===============================================================================================================================
    function get_farmers_data() {
        //the json files which were generated in create_data
        var raw_data = <?php include("data/data_districts_farmers.php"); ?>;
        return JSON.parse(raw_data);
    }

    function get_farmer_percentage_max() {
        return 10.5;
    }

    function get_farmer_percentage(feature) {

        //getting the data
        var data = get_farmers_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon)
        id = Number(feature.id);

        //getting the district name with the id
        district = indexes["District"][id];
        //getting the district average farm size (value) with the district name
        value = Number(data["farmers ratio"][district]);
        value = (Math.round(value * 100) / 100)
        return value;
    }

    function get_farmers(feature) {

        //getting the data
        var data = get_farmers_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon)
        id = Number(feature.id);

        //getting the district name with the id
        district = indexes["District"][id];
        //getting the district average farm size (value) with the district name
        value = Number(data["farmers"][district]);
        value = (Math.round(value * 100) / 100)
        return value;
    }

    function get_population(feature) {

        //getting the data
        var data = get_farmers_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon)
        id = Number(feature.id);

        //getting the district name with the id
        district = indexes["District"][id];
        //getting the district average farm size (value) with the district name
        value = Number(data["population"][district]);
        value = (Math.round(value * 100) / 100)
        return value;
    }
</script>