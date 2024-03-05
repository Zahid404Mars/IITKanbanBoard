#include <iostream>
#include <vector>
#include <queue>
#include <cmath>
#include <climits>

using namespace std;

struct Cell {
    int row, col, f, g, h;

    bool operator>(const Cell& other) const {
        return f > other.f;
    }
};

bool isValid(int row, int col, int numRows, int numCols, const vector<vector<char>>& maze) {
    return (row >= 0 && row < numRows && col >= 0 && col < numCols && maze[row][col] != 'X');
}

int calculateHeuristic(int row, int col, int destRow, int destCol) {
    return abs(row - destRow) + abs(col - destCol);
}

void reconstructPath(vector<vector<char>>& maze, int startRow, int startCol, int destRow, int destCol,
                     const vector<vector<int>>& parentRow, const vector<vector<int>>& parentCol) {
    int row = destRow;
    int col = destCol;

    while (!(row == startRow && col == startCol)) {
        maze[row][col] = 'A';

        int newRow = parentRow[row][col];
        int newCol = parentCol[row][col];

        row = newRow;
        col = newCol;
    }
}

void aStar(vector<vector<char>>& maze, int startRow, int startCol, int destRow, int destCol) {
    int numRows = maze.size();
    int numCols = maze[0].size();

    int dx[] = {-1, 1, 0, 0};
    int dy[] = {0, 0, -1, 1};

    priority_queue<Cell, vector<Cell>, greater<Cell>> pq;

    vector<vector<bool>> visited(numRows, vector<bool>(numCols, false));
    vector<vector<int>> parentRow(numRows, vector<int>(numCols, -1));
    vector<vector<int>> parentCol(numRows, vector<int>(numCols, -1));

    Cell startCell = {startRow, startCol, 0, 0, 0};
    pq.push(startCell);
    visited[startRow][startCol] = true;

    while (!pq.empty()) {
        Cell current = pq.top();
        pq.pop();

        int row = current.row;
        int col = current.col;

        if (row == destRow && col == destCol) {
            reconstructPath(maze, startRow, startCol, destRow, destCol, parentRow, parentCol);
            return;
        }

        for (int i = 0; i < 4; ++i) {
            int newRow = row + dx[i];
            int newCol = col + dy[i];

            if (isValid(newRow, newCol, numRows, numCols, maze) && !visited[newRow][newCol]) {
                int newG = current.g + 1;
                int newH = calculateHeuristic(newRow, newCol, destRow, destCol);
                int newF = newG + newH;

                Cell nextCell = {newRow, newCol, newF, newG, newH};
                pq.push(nextCell);

                visited[newRow][newCol] = true;
                parentRow[newRow][newCol] = row;
                parentCol[newRow][newCol] = col;
            }
        }
    }
}

int main() {
    int numRows, numCols;

    cout << "Enter the number of rows and columns: ";
    cin >> numRows >> numCols;

    vector<vector<char>> maze(numRows, vector<char>(numCols));

    cout << "Enter the maze (use 'S' for start, 'F' for finish, 'X' for obstacles):" << endl;
    for (int i = 0; i < numRows; ++i) {
        for (int j = 0; j < numCols; ++j) {
            cin >> maze[i][j];
        }
    }

    int startRow, startCol, destRow, destCol;

    for (int i = 0; i < numRows; ++i) {
        for (int j = 0; j < numCols; ++j) {
            if (maze[i][j] == 'S') {
                startRow = i;
                startCol = j;
            } else if (maze[i][j] == 'F') {
                destRow = i;
                destCol = j;
            }
        }
    }

    aStar(maze, startRow, startCol, destRow, destCol);

    cout << "Shortest path:" << endl;
    for (int i = 0; i < numRows; ++i) {
        for (int j = 0; j < numCols; ++j) {
            cout << maze[i][j];
        }
        cout << endl;
    }

    return 0;
}
