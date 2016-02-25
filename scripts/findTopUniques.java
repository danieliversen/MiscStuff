import java.io.*;
import java.util.*;

// Author: Daniel Iversen (daniel (AT) nexle.dk ) - Feb 2016

public class findTopUniques{
	public static void main(String[] args){

		System.out.println("\n\n\nFind top/first X unique entries in a file based on file/CSV 'column'\n----\n");

		if(args.length<5){
			System.out.println("ERROR: Not enough arguments");
			System.out.println("Usage: findTopUniques <input file> <delimeter> <column number to compare> <nr of results to bring back per unique value> <output file>\n");
			System.out.println("Example: findTopUniques heres-a-csv-file.csv , 1 2 results.csv\n");
			System.exit(0);
		} else{
			System.out.println("input file name:             " + args[0]);
			System.out.println("delimeter for 'columns':     " + args[1]);
			System.out.println("'columns' number to compare: " + args[2]);
			System.out.println("No. results to bring back:   " + args[3]);
			System.out.println("results output file:         " + args[4]);
			System.out.println("\nPress any key to continue...\n");
			Scanner keyboard = new Scanner(System.in);
			keyboard.nextLine();

		}

        // The name of the file to open.
        String fileName = args[0];

        String outputFileName = args[4];

        int targetColumn = Integer.parseInt(args[2]);


        int maxResultsPerUnique = Integer.parseInt(args[3]);

        // This will reference one line at a time
        String line = null;

        String lastItemValue = "";

        int itemOccurances = 0;

        try {
			PrintWriter writer = new PrintWriter(outputFileName, "UTF-8");

            // FileReader reads text files in the default encoding.
            FileReader fileReader = 
                new FileReader(fileName);

            // Always wrap FileReader in BufferedReader.
            BufferedReader bufferedReader = 
                new BufferedReader(fileReader);

            while((line = bufferedReader.readLine()) != null) {

                String theItem = line.split(args[1])[targetColumn-1];

                //System.out.println(theItem);

                if(theItem.equals(lastItemValue)){
                	itemOccurances++;
                }
                else{
                	itemOccurances=1;
                }
                if(itemOccurances <= maxResultsPerUnique )
                {
                	//System.out.println("should write a line here (item '" + theItem + "'' has only occured " + itemOccurances + " times )...");
                	//System.out.print("\nX" + theItem);

    				writer.println(line);

                	System.out.print("X");

                }
                else{
                	//System.out.println("NOT writing a line here (item '" + theItem + "'' has occured " + itemOccurances + " times which is more than " + maxResultsPerUnique + ")...");	
                	//System.out.print("\n." + theItem);
                	System.out.print(".");
	
                }

            	lastItemValue = theItem;
            }

            // Always close files.
            bufferedReader.close();     

			writer.close();
			System.out.println("\nDone..");

        }
        catch(FileNotFoundException ex) {
            System.out.println(
                "Unable to open file '" + 
                fileName + "'");                
        }
        catch(IOException ex) {
            System.out.println(
                "Error reading file '" 
                + fileName + "'");                  
            // Or we could just do this: 
            // ex.printStackTrace();
        }





	}	
}
