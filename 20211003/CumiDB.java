import java.sql.*;
import java.text.SimpleDateFormat;
import java.io.*;
import java.util.*;
import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import org.json.simple.parser.JSONParser;

public class CumiDB {
	private final String sybaseDriverName = "com.sybase.jdbc3.jdbc.SybDriver";
	private final String sybaseUrlToConnect ="jdbc:sybase:Tds:203.71.250.3:7100/edudb?charset=cp850&;jconnect_version=3";
	private Connection myConnection = null;
	protected CumiDB() {
		try {
			Class.forName(sybaseDriverName);
		} catch(ClassNotFoundException ex) {
			System.out.println(getErrorMessage(ex, "The Driver loaded error,please contact to your Software Designer!").toString());
		}
	}
	protected StringBuffer getErrorMessage(Exception ex,String alarmMessage) {
		StringBuffer errorStringBuffer = new StringBuffer();
		errorStringBuffer.append(alarmMessage);
		errorStringBuffer.append(ex.getMessage());
		return errorStringBuffer;
	}
	protected Connection getConnection() {
		try {
			this.myConnection = DriverManager.getConnection(sybaseUrlToConnect,"rscom","skyrscom");
		} catch(Exception ex) {
			System.out.println(getErrorMessage(ex, "Can not get connection,please contact to your Software Designer!").toString());
		}
		return this.myConnection;
	}
	protected static ArrayList<String> gtables() {
		ArrayList<String> returns = new ArrayList<String>();
		CumiDB cCumiDB = new CumiDB();
		try {
			Connection cConnection = cCumiDB.getConnection();
			DatabaseMetaData cConMeta = cConnection.getMetaData();
			ResultSet cTables = cConMeta.getTables(null, null,"%", null);
			while(cTables.next()){
				if(cTables.getString(3).matches("V_RS_Student")){
					System.out.println(cTables.getString(3));
					returns.add(cTables.getString(3));
				}
				if(cTables.getString(3).matches("V_RS_StuClass")){
					System.out.println(cTables.getString(3));
					returns.add(cTables.getString(3));
				}
				if(cTables.getString(3).matches("V_RS_Class")){
					System.out.println(cTables.getString(3));
					returns.add(cTables.getString(3));
				}
				if(cTables.getString(3).matches("V_RS_Stucour")){
					System.out.println(cTables.getString(3));
					returns.add(cTables.getString(3));
				}
				if(cTables.getString(3).matches("V_RS_Cour")){
					System.out.println(cTables.getString(3));
					returns.add(cTables.getString(3));
				}
				if(cTables.getString(3).matches("V_RS_Teachcour")){
					System.out.println(cTables.getString(3));
					returns.add(cTables.getString(3));
				}
			}
		} catch(Exception ex) {
			//System.out.println(myCumiDB.getErrorMessage(ex, "Application error, please contact to your Software Designer!").toString());
		}
		return returns;
	}
	protected static void dump_sql(String DBName, String TableName) {
		CumiDB myCumiDB = new CumiDB();
		int read_nums = 0;
		try {
			Connection myConnection = myCumiDB.getConnection();
			PreparedStatement myPreparedStatement;
			if(TableName.matches("V_RS_Class")) {
				System.out.println("SELECT * FROM " + DBName + "." + TableName + " WHERE Year = 110 AND Semester = 1");
				myPreparedStatement = myConnection.prepareStatement("SELECT * FROM " + DBName + "." + TableName + " WHERE Year = 110 AND Semester = 1");
			} else if(TableName.matches("V_RS_Cour")){
				System.out.println("SELECT * FROM " + DBName + "." + TableName + " WHERE Year = 110 AND Semester = 2");
				myPreparedStatement = myConnection.prepareStatement("SELECT * FROM " + DBName + "." + TableName + " WHERE Year = 110 AND Semester = 1");
			} else if(TableName.matches("V_RS_StuClass")){
				System.out.println("SELECT * FROM " + DBName + "." + TableName + " WHERE Year = 110 AND Semester = 1");
				myPreparedStatement = myConnection.prepareStatement("SELECT * FROM " + DBName + "." + TableName + " WHERE Year = 110 AND Semester = 1");
			} else if(TableName.matches("V_RS_Stucour")){
				System.out.println("SELECT * FROM " + DBName + "." + TableName + " WHERE Year = 110 AND Semester = 1");
				myPreparedStatement = myConnection.prepareStatement("SELECT * FROM " + DBName + "." + TableName + " WHERE Year = 110 AND Semester = 1");
			} else if(TableName.matches("V_RS_Student")){
				System.out.println("SELECT * FROM " + DBName + "." + TableName);
				myPreparedStatement = myConnection.prepareStatement("SELECT * FROM " + DBName + "." + TableName);
			} else if(TableName.matches("V_RS_Teachcour")){
				System.out.println("SELECT * FROM " + DBName + "." + TableName);
				myPreparedStatement = myConnection.prepareStatement("SELECT * FROM " + DBName + "." + TableName);
			} else {
				System.out.println("SELECT * FROM " + DBName + "." + TableName);
				myPreparedStatement = myConnection.prepareStatement("SELECT * FROM " + DBName + "." + TableName);
			}
			
			ResultSet myResultSet = myPreparedStatement.executeQuery();
			
			StringBuffer myStringBuffer = new StringBuffer();
			
			//MetaData
			ResultSetMetaData rsmd = myResultSet.getMetaData();
			//System.out.println("row nums = " + rsmd.getColumnCount());
			Writer writer = new BufferedWriter( new OutputStreamWriter(new FileOutputStream(TableName + ".sql"), "UTF-8"));
			String insert_base = "INSERT INTO `" + TableName + "`(";
			for(int i=0; i<rsmd.getColumnCount(); i++){
				if(i < (rsmd.getColumnCount() - 1)){
					insert_base += "`" + rsmd.getColumnName(i + 1) + "`,";
				}else{
					insert_base += "`" + rsmd.getColumnName(i + 1) + "`)VALUES(";
				}
			}
			while(myResultSet.next()) {
				read_nums++;
				String insert_return = insert_base;
				for(int i=0; i<rsmd.getColumnCount(); i++){
					if(i < (rsmd.getColumnCount() - 1)){
						String temp = myResultSet.getString(i + 1);
						if (temp != null) {
							byte[] b = temp.getBytes("CP850");
							temp = new String(b, "BIG5");
							insert_return += "'" + temp + "',";
						} else {
							insert_return += "'',";
						}
					}else{
						String temp = myResultSet.getString(i + 1);
						if (temp != null) {
							byte[] b = temp.getBytes("CP850");
							temp = new String(b, "BIG5");
							insert_return += "'" + temp + "')";
						} else {
							insert_return += "'')";
						}
					}
					
				}
				myStringBuffer.append(insert_return + ";\n");
			}
			String a = new String(myStringBuffer.toString());
			//System.out.println(a);
			writer.write(a);
			System.out.println("{\"type\": \"sql\", \"table_name\": \"" + TableName + "\", \"col_nums\":"+ rsmd.getColumnCount() +", \"row_nums\":" + read_nums + "}");
			writer.close();
		} catch(Exception ex) {
			System.out.println(myCumiDB.getErrorMessage(ex, "Application error, please contact to your Software Designer!").toString());
		}
	}
	protected static void dump_json(String DBName, String TableName) {
		CumiDB myCumiDB = new CumiDB();
		int read_nums = 0;
		try {
			//output file
			Writer writer = new BufferedWriter( new OutputStreamWriter(new FileOutputStream(TableName + ".json"), "UTF-8"));
			
			Connection myConnection = myCumiDB.getConnection();
			
			PreparedStatement myPreparedStatement = myConnection.prepareStatement("SELECT * FROM " + DBName + "." + TableName);
			ResultSet myResultSet = myPreparedStatement.executeQuery();
			
			StringBuffer myStringBuffer = new StringBuffer();
			
			//MetaData
			ResultSetMetaData rsmd = myResultSet.getMetaData();
			JSONObject arr = new JSONObject();
			while(myResultSet.next()) {
				read_nums++;
				JSONObject obj = new JSONObject();
				for(int i=0; i<rsmd.getColumnCount(); i++){
					//key=>valye
					obj.put(rsmd.getColumnName(i + 1), myResultSet.getString(i + 1));
				}
				arr.put(read_nums, obj);
			}
			String json_str = new String(arr.toJSONString().getBytes("CP850"));
			json_str = json_str.replace("\\", "");
			writer.write(json_str);
			System.out.println("{\"type\": \"json\", \"table_name\": \"" + TableName + "\", \"col_nums\":"+ rsmd.getColumnCount() +", \"row_nums\":" + read_nums + "}");
			writer.close();
		} catch(Exception ex) {
			System.out.println(myCumiDB.getErrorMessage(ex, "Exception").toString());
		}
	}
	public static void main(String[] args) {
		//String table_name = args[0];					//dbname
		//dump_sql("edudb.dbo", table_name);
		//dump_sql("edudb.dbo", "V_RS_Teachcour");
		ArrayList<String> tbs = gtables();
		for(String element : tbs) {
			dump_sql("edudb.dbo", element);
			//dump_json("edudb.dbo", element);
		}
		//dump_sql("edudb.dbo", "V_RS_Tteachcour");
		//dump_json("edudb.dbo", "V_RS_Tteachcour");
	}
}
