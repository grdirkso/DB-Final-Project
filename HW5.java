import java.sql.*;
import java.util.Properties;
import java.util.Scanner;
import java.text.DecimalFormat;
public class HW5 {
	private Connection connection;
	private Statement statement;
	
	public HW5() {
		connection = null;
		statement = null;
	}

	public static void main(String[] args) throws Exception{
		String Username="grdirkso";
		String Password="G#Dirk$o223";
		HW5 db = new HW5();
		db.connect(Username, Password);
		db.initDatabase(Username, Password, Username);
		String function = args[0];
		if(function.equals("addStudent")) {
			String id = args[1];
			String fname = args[2];
			String lname = args[3];
			String major = args[4];
			db.addStudent(id, fname, lname, major);
		}
        else if(function.equals("addCourse")) {
			String code = args[1];
			String number = args[2];
			String title = args[3];
			String hours = args[4];
			db.addCourse(code, number, title, hours);
		else if(function.equals("viewCourses")){
			String dep = args[1];
			db.viewCourses(dep);
		}
	}

	public void addStudent(String id, String fname, String lname, String major) throws SQLException  {
		String values = " ' " + id + " ',' " + fname + " " + lname +" ',' " + major + " '"; 

		try {
			statement.executeUpdate("INSERT into STUDENT values("+values+")");
			//insert("STUDENT", values);
			String q = "SELECT * FROM STUDENT;";
			ResultSet resultSet = statement.executeQuery(q);
			print(resultSet);
		}
		catch(SQLException e) {
			System.out.println(e);
			System.out.println("Unsuccessful insert into STUDENT");
		}
	}

    public void addCourse(String code, String number, String title, String hours) throws SQLException  {
        try{
            statement = connection.createStatement();
            statement.executeUpdate("USE grdirkso;");
            String query = "INSERT into COURSE values (NULL,'"+ code +"','"+ number+"','"+ title + "',"+ hours+");";
            statement.executeUpdate(query);
            String q = "SELECT * FROM COURSE;";
			ResultSet resultSet = statement.executeQuery(q);
			print(resultSet);
        } 
        catch(SQLException e) {
			System.out.println(e);
			System.out.println("Unsuccessful insert into Course");
		}
    }
	public void viewCourses(String department) {
		String q = "SELECT * FROM COURSE WHERE DEPARTMENT_CODE = '" + department + "';";
		try {
			ResultSet results = statement.executeQuery(q);
			print(results);
		}
		catch(SQLException e) {
			System.out.println(e);
			System.out.println("Unsuccessful select from COURSE");
		}
	}

	public void connect(String Username, String mysqlPassword) throws Exception {
        try {
	  Class.forName("com.mysql.jdbc.Driver"); 	
	  connection = DriverManager.getConnection("jdbc:mysql://localhost/" + Username + "?user=" + Username + "&password=" + mysqlPassword);
        }
        catch (Exception e) {
            System.out.println("error");
		throw e;
        }
    }

	// Execute an SQL query passed in as a String parameter
    // and print the resulting relation
    public void query(String q) {
        try {
            ResultSet resultSet = statement.executeQuery(q);
            System.out.println("\n---------------------------------");
            System.out.println("Query: \n" + q + "\n\nResult: ");
            print(resultSet);
        }
        catch (SQLException e) {
            e.printStackTrace();
        }
    }

    // Print the results of a query with attribute names on the first line
    // Followed by the tuples, one per line
    public void print(ResultSet resultSet) throws SQLException {
        ResultSetMetaData metaData = resultSet.getMetaData();
        int numColumns = metaData.getColumnCount();

        printHeader(metaData, numColumns);
        printRecords(resultSet, numColumns);
    }

    // Print the attribute names
    public void printHeader(ResultSetMetaData metaData, int numColumns) throws SQLException {
        for (int i = 1; i <= numColumns; i++) {
            if (i > 1)
                System.out.print(",  ");
            System.out.print(metaData.getColumnName(i));
        }
        System.out.println();
    }

    // Print the attribute values for all tuples in the result
    public void printRecords(ResultSet resultSet, int numColumns) throws SQLException {
        String columnValue;
        while (resultSet.next()) {
            for (int i = 1; i <= numColumns; i++) {
                if (i > 1)
                    System.out.print(",  ");
                columnValue = resultSet.getString(i);
                System.out.print(columnValue);
            }
            System.out.println("");
        }
    }

    // Insert into any table, any values from data passed in as String parameters
    public void insert(String table, String values) {
        String query = "INSERT into " + table + " values (" + values + ")" ;
        try {
            statement.executeUpdate(query);
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    // Remove all records and fill them with values for testing
    // Assumes that the tables are already created
    public void initDatabase(String Username, String Password, String SchemaName) throws SQLException {
        statement = connection.createStatement();
		statement.executeUpdate("DELETE from ENROLLMENT");
        statement.executeUpdate("DELETE from STUDENT");
        statement.executeUpdate("DELETE from COURSE");
		statement.executeUpdate("ALTER TABLE COURSE AUTO_INCREMENT = 101;");
		statement.executeUpdate("ALTER TABLE ENROLLMENT AUTO_INCREMENT = 201;");

        insert("STUDENT", "'010816228', 'CAROLINE GSCHWEND', 'COMPUTER SCIENCE'");
        insert("STUDENT", "'010814651', 'GILLIAN DIRKSON', 'COMPUTER SCIENCE'");

        insert("COURSE", " NULL,'CSCE', '4523', 'DATABASE', 3");
        insert("COURSE", "NULL,'CSCE', '4813', 'GRAPHICS', 3");
    
        insert("ENROLLMENT", " NULL,'010814651', 101");
		insert("ENROLLMENT", " NULL,'010814651', 102");
        insert("ENROLLMENT", " NULL,'010816228', 101");
        
    }
}	
