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
		//connect to MYSQL
		String Username="grdirkso";
		String Password="G#Dirk$o223";
		HW5 db = new HW5();
		db.connect(Username, Password);
		db.initDatabase(Username, Password, Username);
		//get the first argument, this is the function
		//the arguments after are the parameters
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
		} 
        else if(function.equals("addApplication")) {
			String s_ID = args[1];
			String code = args[2];
			String number = args[3];
			db.addApplication(s_ID, code, number);
		}
        else if(function.equals("viewStudents")){
			db.viewStudents();
		}
		else if(function.equals("viewCourses")){
			String dep = args[1];
			db.viewCourses(dep);
		}
		else if(function.equals("viewCoursesForStudent")){
			String id = args[1];
			db.viewCoursesForStudent(id);
		}
		else {
			System.out.println("error");
		}
	}

	//adds a student to the db 
	//needs student id, name and major
	public void addStudent(String id, String fname, String lname, String major) throws SQLException  {
		String values = " ' " + id + " ',' " + fname + " " + lname +" ',' " + major + " '"; 

		try {
			//if the student id is not already in the db then insert
			ResultSet student = statement.executeQuery("SELECT * FROM STUDENT WHERE S_ID ='" + id + "';" );
            if(!student.next()){
				//insert student
				statement.executeUpdate("INSERT into STUDENT values("+values+")");
				//show the students in the db
				String q = "SELECT * FROM STUDENT;";
				ResultSet resultSet = statement.executeQuery(q);
				print(resultSet);
			}
			//if student already in the db, notify user
			else {
				System.out.println("That student already exists in the database");
			}
		}
		//something is wrong with what the user supplied 
		catch(SQLException e) {
			System.out.println(e);
			System.out.println("Unsuccessful insert into STUDENT");
		}
	}

	//add a course to the db
	//takes in department code, course number, title and hours
    public void addCourse(String code, String number, String title, String hours) throws SQLException  {
        try{
            statement = connection.createStatement();
            statement.executeUpdate("USE grdirkso;");
            ResultSet course = statement.executeQuery("SELECT * FROM COURSE WHERE DEPARTMENT_CODE = '" + code + "' AND COURSE_NUM = '" + number +"';");
			//if exact course not in db then insrt
			if(!course.next()){
              String query = "INSERT into COURSE values (NULL,'"+ code +"','"+ number+"','"+ title + "',"+ hours+");";
              statement.executeUpdate(query);
			  //show all courses in the db
              String q = "SELECT * FROM COURSE;";
			  ResultSet resultSet = statement.executeQuery(q);
			  print(resultSet);  
              System.out.println("Course Successfully Inserted");
			//exact course is in the db
            } else {
               System.out.println("That course already exists in the system"); 
            }
            
        } 
		//something is wrong with what the user has entered
        catch(SQLException e) {
			System.out.println(e);
			System.out.println("Unsuccessful insert into Course");
		}
    }
    //add application to db
	//takes student id, course code and course number
    public void addApplication(String s_ID, String code, String number) throws SQLException  {
        try{
            statement = connection.createStatement();
            statement.executeUpdate("USE grdirkso;");
			//get C_ID from course table 
			ResultSet cID = statement.executeQuery("SELECT C_ID FROM COURSE WHERE DEPARTMENT_CODE ='"+ code +"' AND COURSE_NUM ='"+ number +"';");
			cID.next();
			//convert ResultSet to string
			String c_id = cID.getString(1);
			ResultSet enrollment = statement.executeQuery("SELECT * FROM ENROLLMENT WHERE STUDENT_ID ='" + s_ID + "'AND COURSE_ID = '" + c_id + "';" );
            //if application not in the db then insert
			if(!enrollment.next()){
				String query = "INSERT into ENROLLMENT values (NULL,'"+ s_ID +"',"+ c_id +");";
            	statement.executeUpdate(query);
				//join enrollment and course tables
				//show student ID, and all information of couse they are in
            	String q = "SELECT STUDENT_ID, DEPARTMENT_CODE, COURSE_NUM, TITLE, HOURS FROM ENROLLMENT natural join COURSE where COURSE_ID = C_ID;";
				ResultSet resultSet = statement.executeQuery(q);
				print(resultSet);
			}
			//application already exists in the db
			else {
				System.out.println("That student is already enrolled in that course");
			}
        } 
		//something is wrong with what the user has entered
        catch(SQLException e) {
			System.out.println(e);
			System.out.println(" Unsuccessful insert into Course");
		}
    }
	//vire students
    public void viewStudents() {
		String q = "SELECT * FROM STUDENT;";
		try {
			//shows all students in the db
			ResultSet results = statement.executeQuery(q);
			print(results);
		}
		//there are currently no students in the db
		catch(SQLException e) {
			System.out.println(e);
			System.out.println("No Students to display");
		}
	}
	//view courses
	//takes in detartment
	public void viewCourses(String department) {
		//find all courses in the given department
		String q = "SELECT * FROM COURSE WHERE DEPARTMENT_CODE = '" + department + "';";
		try {
			//show the selection
			ResultSet results = statement.executeQuery(q);
			print(results);
		}
		//there are no courses in thet department
		catch(SQLException e) {
			System.out.println(e);
			System.out.println("Unsuccessful select from COURSE");
		}
	}

	//view courses that a student is in
	//takes in student id
	public void viewCoursesForStudent(String id) {
		//get all courses a student is in
		String q = "SELECT * FROM COURSE JOIN ENROLLMENT  WHERE COURSE_ID = C_ID AND  STUDENT_ID = '" + id + "';";
		try {
			//display the courses
			ResultSet results = statement.executeQuery(q);
			print(results);
		}
		//something is wrong with what the user has entered
		catch(SQLException e) {
			System.out.println(e);
			System.out.println("Unsuccessful select from COURSE JOINED ENROLLMENT");
		}
	}

	//connect to the db
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
        System.out.println(" |");
    }

    // Print the attribute values for all tuples in the result
    public void printRecords(ResultSet resultSet, int numColumns) throws SQLException {
        String columnValue;
        while (resultSet.next()) {
            for (int i = 1; i <= numColumns; i++) {
                if (i > 1)
                    System.out.print(", ");
                columnValue = resultSet.getString(i);
                System.out.print(columnValue);
            }
            System.out.println(" |");
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
		statement.executeUpdate("ALTER TABLE COURSE AUTO_INCREMENT = 101;");
		statement.executeUpdate("ALTER TABLE ENROLLMENT AUTO_INCREMENT = 201;");
    }
}	
